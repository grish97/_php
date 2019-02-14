<?php

namespace Core;

class View
{
    protected $content = '';

    public function render($view, $title, $params = []) {
        $pageView = $this->getView($view, $params);
        $layout = $this->getView('layout.main',$params);
        $this->content = str_replace('@content',$pageView,$layout);
        $this->content = str_replace('@title',$title,$this->content);
        return $this->content;
    }

    public function getView($view, $params) {
        $path =  views_path($view);
        if(file_exists($path)) {
            ob_start();
            require "$path";
            extract($params);
            return ob_get_clean();
        }
    }

}