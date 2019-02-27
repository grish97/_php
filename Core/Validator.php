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
        $_data[$field] = isset($_data[$field]) ? trim($_data[$field])  : '';

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
                $pattern = "/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,7}|[0-9]{1,3})(\]?)$/";
                $match = preg_match($pattern,$_data[$field]);
                if(!$match) {
                    $this->errorMessage($field,$rule);
                }
            break;
            case 'number' :
                $pattern = "/^[0-9]*$/";
                $match = preg_match($pattern,$_data[$field]);
                if(!$match) {
                    $this->errorMessage($field,$rule);
                }
            break;
            case 'string' :
                $pattern = '/^(([A-za-z]+[\s]{1}[A-za-z]+)|([A-Za-z]+))$/';
                $match = preg_match($pattern,$_data[$field]);
                if(!$match) $this->errorMessage($field,$rule);
                break;
            case 'confirmed':
                if ($_data[$field] !== $_data['conf_' . $field]) $this->errorMessage($field,$rule);
            break;
            case 'unique':
                $parts = explode(',',$arg);
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
           'number' => "Field must be number",
           'string' => "Field must be string",

       ];
       $errorMsg = $message[$rule];
       $this->addError($field,$errorMsg);
    }

    public function addError($field,$message) {
        $_SESSION['errors'][$field] = $message;
    }

}