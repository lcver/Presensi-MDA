<?php

namespace App\Core;
/**
 * 
 * 
 */
class App
{
    protected $controller = 'HomeController';
	protected $method = 'index';
	protected $params = [];

    public function  __construct()
    {
        $url = $this->parseURL();
        $url[0] = is_null($url) ? "" : ucwords($url[0]);
        // var_dump($url);

        /**
         * 
         * Controller url
         */

        if(file_exists('../App/controllers/'.$url[0].'Controller.php'))
        {
            $this->controller = $url[0].'Controller';
            unset($url[0]);
        }
        
        require_once '../App/controllers/'.$this->controller.'.php';
        $this->controller = new $this->controller;

        /**
         * 
         * Methods url
         */
        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
			{
				$this->method = $url[1];
				unset($url[1]);
			}
        }

        /**
         * 
         * Parameter url
         */
        if(!empty($url))
        {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    public function parseURL()
    {
        if( isset($_GET['url']) )
        {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}
