<?php

/**
 * Created by PhpStorm.
 * User: tsuyogbasnet
 * Date: 7/16/16
 * Time: 12:38 PM
 */
class Router{
    protected $uri;
    protected $controller;
    protected $action;
    protected $route;
    protected $method_prefix;
    protected $languages;
    protected  $params;


    public function __construct($uri){
        $this->uri = urldecode(trim($uri, '/'));
        //get defaults
        $routes = Config::get("routes");
        $this->route = Config::get('default_route');
        $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
        $this->languages = Config::get('default_language');
        $this->controller = Config::get("default_controller");
        $this->action = Config::get("default_action");

        $uri_parts = explode('?',$this->uri);
        $paths = $uri_parts[0];


        //for this application root directory is mvc, so slice array
        $path_part = array_slice(explode('/', $paths),1, count(explode('/', $paths))-1);
        if (count($path_part)){
            //get route or language at first element
            if (in_array(strtolower(current($path_part)), array_keys($routes))){
                $this->route = strtolower(current($path_part));
                $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
                array_shift($path_part);
            }elseif (in_array(strtolower(current($path_part)), Config::get('language'))){
                $this->languages= strtolower(current($path_part));
                array_shift($path_part);
            }
            //get controller
            //check whether the controller is in url or not
            if (current($path_part)){
                $this->controller = strtolower(current($path_part));
                array_shift($path_part);
            }
            //get action
            //check whether the action is in url or not
            if (current($path_part)){
                $this->action= strtolower(current($path_part));
                array_shift($path_part);
            }
            $this->params = $path_part;
        }

    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return mixed
     */
    public function getMethodPrefix()
    {
        return $this->method_prefix;
    }

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        return $this->languages;
    }


    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }


}