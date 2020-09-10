<?php

namespace App\Core;
/**
 * 
 * 
 */
class Controller
{
    public function view($view, $data=[], $category="")
    {
        /**
         * 
         * Set Template
         */
        if($category==="self")
        {
            $template=[$view];
        }elseif($category==="peserta"){
            $template = [
                'Template/peserta/header',
                'Template/peserta/navbar',
                'Template/peserta/contentHeader',
                $view,
                'Template/peserta/contentFooter',
                'Template/peserta/footer'
            ];
        }elseif ($category==="admin") {
            $template = [
                'Template/header',
                'Template/navbar',
                'Template/sidebar',
                $view,
                'Template/modal/index',
                'Template/footer'
            ];
        }else{
            $template = [
                'Template/peserta/header',
                'Template/peserta/navbar',
                'Template/peserta/contentHeader',
                $view,
                'Template/peserta/contentFooter',
                'Template/footer'
            ];
        }
        $count = count($template);

        /**
         * 
         * running page
         */
        $i=0;
        while ($i < $count) {
            require_once '../App/views/'.$template[$i].'.php';
            $i++;}
    }

    public function model($model)
    {
        require_once '../App/models/' . $model . '.php';
        return new $model;
    }
}
