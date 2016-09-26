<?php
/**
 * Created by PhpStorm.
 * User: tsuyogbasnet
 * Date: 7/16/16
 * Time: 5:40 PM
 */
class View {
    protected $data;
    protected $path;

    public function __construct($data = array(), $path = null){
        if (!$path){
            $path = self::getDefaultViewPath();
        }
        if (!file_exists($path)){
            throw new Exception("Template file does not exist ".$path);
        }
        $this->path = $path;
        $this->data = $data;
    }
    public static function getDefaultViewPath(){
        $router = App::getRouter();
        if (!$router){
            return false;
        }
        $controller_dir = $router->getController();
        $template_name = $router->getMethodPrefix().$router->getAction().'.html';

        return VIEW_PATH.DS.$controller_dir.DS.$template_name;
    }

    public function render(){
        $data = $this->data;
        //turn output buffering on
        ob_start();

        include($this->path);
        $content = ob_get_clean();

        return $content;
    }
}