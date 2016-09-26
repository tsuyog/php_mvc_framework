<?php
/**
 * Created by PhpStorm.
 * User: tsuyogbasnet
 * Date: 7/16/16
 * Time: 12:48 PM
 */
require_once(ROOT.DS.'config'.DS.'config.php');

function __autoload($class_name){
    //load core
    $core_path = ROOT.DS.'core'.DS.strtolower($class_name).'.class.php';
    //load controller classes
    $controller_path = ROOT.DS.'application'.DS.'controllers'.DS.str_replace('controller','',strtolower($class_name)).'.php';
    //load model
    $model_path = ROOT.DS.'application'.DS.'models'.DS.strtolower($class_name).'.php';
    //load data access layer
    $dal_path = ROOT.DS.'dal'.DS.strtolower($class_name).'.php';

    //load libraries
    $lib_path  = ROOT.DS.'lib'.strtolower($class_name).'.php';


    if (file_exists($core_path)){
        require_once $core_path;
    }elseif (file_exists($controller_path)){
        require_once $controller_path;
    }elseif (file_exists($model_path)){
        require_once $model_path;
    }elseif (file_exists($dal_path)){
        require_once $dal_path;
    }else if (file_exists($lib_path)){
        require_once $lib_path;
    }else {
        throw new Exception("Failed to include class: ".$class_name);
    }
}