<?php

namespace Core;

class View
{
    protected $content = '';

    public function render($view,$title) {
        $pageView = $this->getView($view);
        $layout = $this->getView('layout.main');
        $this->content = str_replace('@content',$pageView,$layout);
        $this->content = str_replace('@title',$title,$this->content);
        return $this->content;
    }

    public function getView($view) {
        $path =  views_path($view);
        if(file_exists($path)) {
            ob_start();
            require "$path";
            return ob_get_clean();
        }
    }

}