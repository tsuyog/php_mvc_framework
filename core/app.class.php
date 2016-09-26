<?php
/**
 * Created by PhpStorm.
 * User: tsuyogbasnet
 * Date: 7/16/16
 * Time: 2:55 PM
 */
class App{
    protected static $router;
    public static $db;

    /**
     * @return mixed
     */
    public static function getRouter()
    {
        return self::$router;
    }
    //to process request
    public static function run($uri){
        //database object
        self::$db = new DB(Config::get('host'), Config::get('user'), Config::get('password'), Config::get('db_name'));

        self::$router = new Router($uri);
        $controller_class = ucfirst(self::$router->getController())."Controller";
        $controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction());
        //calling controllers method
        $controller_object = new $controller_class;
        if (method_exists($controller_object, $controller_method)){
            //$result = $controller_object->$controller_method();
            $view_path = $controller_object->$controller_method();
            $view_object = new View($controller_object->getData(), $view_path);
            $content = $view_object->render();

        }else {
            throw new Exception("Method ".$controller_method. " of ".$controller_class. " does not exits");
        }
        //rendering view
        $layout = self::$router->getRoute();
        $layout_path = VIEW_PATH.DS.$layout.'.html';
        $layout_view_object = new View(compact('content'), $layout_path);
        echo $layout_view_object->render();
    }

}