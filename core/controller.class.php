<?php
/**
 * Created by PhpStorm.
 * User: tsuyogbasnet
 * Date: 7/16/16
 * Time: 4:27 PM
 */
class Controller {

    protected $data;

    // access to model object
    protected $model;

    //storing params
    protected $params;

    //dal object
    protected $dal;


    public function __construct($data = array()){
        $this->data = $data;
        $this->params = App::getRouter()->getParams();
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }
    //to transfer data to view


}