<?php
/**
 * Created by PhpStorm.
 * User: tsuyogbasnet
 * Date: 7/17/16
 * Time: 4:52 PM
 */
class DB {
    protected $connection;

    public  function __construct($host, $user, $password, $db){
        $this->connection = new mysqli($host,$user, $password, $db);
        if (mysqli_connect_errno()){
            throw  new Exception("Could not connect to database");
        }
    }

    public function executeQuery($query){
        if (!$this->connection){
            return false;
        }
        $result = $this->connection->query($query);
        if (mysqli_errno($this->connection)){
            throw new Exception($this->connection);
        }
        //if result_set is boolean
        if (is_bool($result)){
            return $result;
        }
        return $result;
    }

    public function escape($str){
        return mysqli_escape_string($this->connection, $str);
    }

    public function closeConnection(){
        $this->connection->close();
    }

}