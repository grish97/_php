<?php

namespace Core;

use app\Models\Users;

class Validator
{
    private $data;
    private $rule;

    public function __construct($data,$rule) {
        $this->data = $data;
        $this->rule = $rule;
    }

    public function validate () {
        foreach($this->rule as $field => $_rule) {
            $rules = explode('|',$_rule);

            for ($i = 0; $i < count($rules);$i++) {
                $args = explode(':',$rules[$i]);
                $ruleName = $args[0];
                $ruleArg  = isset($args[1]) ? $args[1] : '';
                $this->validateField($field,$ruleName,$ruleArg);
            }
        }

        if(!empty($_SESSION['errors'])) $_SESSION['values'] = $this->data;
    }

    private function validateField($field,$rule,$arg) {
        $_data = $this->data;
        switch($rule) {
            case 'required':
                if(empty($_data[$field])) $this->errorMessage($field,$rule);
            break;
            case 'min':
                if (strlen($_data[$field]) < $arg) $this->errorMessage($field,$rule,$arg);
            break;
            case 'max':
                if(strlen($_data[$field]) > $arg) $this->errorMessage($field,$rule,$arg);
            break;
            case 'email':
                $pattern = "/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/";
                $match = preg_match($pattern,$_data[$field]);
                if(!$match) {
                    $this->errorMessage($field,$rule);
                }
            break;
            case 'number' :
                if(is_nan(isset($_data[$field]))) $this->errorMessage($field,$rule);
            break;
            case 'confirmed':
                if ($_data[$field] !== $_data['conf_' . $field]) $this->errorMessage($field,$rule);
            break;
            case 'unique':
                $parts = explode(',',$arg);
                $table = $parts[0];
                $column = $parts[1];
                $email = Users::query()->where($column,'=',$_data[$field])->get()->first();

                if(!empty($email)) $this->errorMessage($field,$rule);
            break;
            default;
        }
    }

    public function errorMessage($field,$rule,$arg = '') {
       $message = [
           'required' => 'This field is required',
           'min'    => "This field value must be higher $arg",
           'max'  => "This field value must be lower $arg",
           'email' => 'Email address is not valid',
           'unique' => 'This Email was registered',
           'confirmed' => 'Please confirm password',
           'number' => "$field must be number"
       ];

       $errorMsg = $message[$rule];
       $this->addError($field,$errorMsg);
    }

    public function addError($field,$message) {
        $_SESSION['errors'][$field] = $message;
    }

}