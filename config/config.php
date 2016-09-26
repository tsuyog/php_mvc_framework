<?php

/**
 * Created by PhpStorm.
 * User: tsuyogbasnet
 * Date: 7/16/16
 * Time: 12:46 PM
 * general purpose for some constant
 */
Config::set('app_name', "Mini Mvc");

//lang setting
Config::set('language',array('en','es'));

//Route setup, Route route = method prefix
Config::set('routes', array(
    'default'=> '',
    'admin' => 'admin_' // _ makes easy to invoke admin controller methods
    ));

Config::set('default_route', 'default');
Config::set('default_language', 'en');
Config::set("default_controller", 'welcome');
Config::set("default_action", 'index');

//database parameters
Config::set('host', 'localhost');
Config::set('user', 'root');
Config::set('password', 'root');
Config::set('db_name', 'mvc');