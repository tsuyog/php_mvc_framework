<?php
/**
 * Created by PhpStorm.
 * User: tsuyogbasnet
 * Date: 7/17/16
 * Time: 6:24 PM
 */
class Repository {
    //protected $db;

    protected static function getDb(){
        return new DB(Config::get('host'), Config::get('user'), Config::get('password'), Config::get('db_name'));
    }
    public function bind($data){
        foreach($data as $key=>$value){
            $this->$key = $value;
        }
    }

    public function add(){
        $db = self::getDb();
        $query = $this->prepQuery('add');
        $result = $db->executeQuery($query);
        $db->closeConnection();
        if ($result) return true;
        else return false;
        /*$obj = get_class_vars(get_class($this));
        print_r($obj);
        foreach ($obj as $key=>$value){

        }*/
    }
    public function add_range(){
        // think and write about it
        $db = self::getDb();
        $obJ = get_class_vars(get_class($this));
        foreach ($obJ as $key => $value){
            //make SQL and pass it to database class
        }
    }
    //this function returns selected attributes from database
    public function load($data = array()){
        var_dump($data);
        $db = self::getDb();
        $object_list = array();
        $query = $this->prepQuery('load');
        $query = $db->escape($query);
        $raw_data = $db->executeQuery($query);
        $obj = get_class($this);
        //this method needs to be modified
        if ($raw_data){
            foreach ($raw_data as $row){
                $data_object = new $obj;
                foreach ($row as $key=>$value){
                    $data_object->$key = $value;
                }
                array_push($object_list, $data_object);
            }
        }
        return $object_list;

    }
    //returns the whole column from table
    public function load_multiple(){
        $db = self::getDb();
        $object_list= array();
        $query = $this->prepQuery('load_multiple');
        $db->escape($query);
        $raw_data = $db->executeQuery($query);
        $db->closeConnection();
        if ($raw_data){
            //serialize the data rows into object and send to caller
            //print_r($raw_data); die;
            $obj = get_class($this);
            foreach ($raw_data as $row){
                $data_object = new $obj;
                foreach ($row as $key=>$value){
                    $data_object->$key = $value;
                }
                array_push($object_list, $data_object);
            }
        }
        return $object_list;
    }
    //update function
    //receives a object as parameters
    public function update(){
        $db = self::getDb();
        $query = $this->prepQuery('update');
        $update = $db->executeQuery($query);
        $db->closeConnection();
        if ($update){
            return true;
        }else {
            return false;
        }
    }

    //remove function
    public function remove(){
        $db = self::getDb();
        $query = $this->prepQuery('remove');
        //use escape function
        $remove = $db->executeQuery($query);
        $db->closeConnection();
        if ($remove){ return true;}
        else{ return false; }
    }

    public function findBy(){
        $db = self::getDb();
        $object_list = array();
        $query = $this->prepQuery('find_by');
        $db->escape($query);
        $raw_data = $db->executeQuery($query);
        $db->closeConnection();
        if ($raw_data){
            //serialize the data rows into object and send to caller
            //print_r($raw_data); die;
            $obj = get_class($this);
            foreach ($raw_data as $row){
                $data_object = new $obj;
                foreach ($row as $key=>$value){
                    $data_object->$key = $value;
                }
                array_push($object_list, $data_object);
            }
        }
        return $object_list;
    }

    protected function prepQuery($operation){
        switch ($operation){
            case 'add':
                //do some adding operation
                $db = self::getDb();
                $add_table = strtolower(get_class($this));
                $add_table_vars = get_class_vars(get_class($this));
                $field_names ="";
                $field_values ="";
                foreach ($add_table_vars as $key=>$value){
                    if ($this->$key){
                        $field_names .= "{$key}, ";
                        $temp = $db->escape($this->$key);
                        $field_values .= "'{$temp}',";
                    }
                }
                $field_names = substr($field_names, 0, -2);
                $field_values = substr($field_values, 0, -1);
                $query = "INSERT INTO {$add_table} ({$field_names}) VALUES ({$field_values})";
                return $query;

            case 'add_range':
                //add multiple rows
                break;

            case 'load':
                //load given parameters
                $query = '';//"SELECT ".join(',', $selectable).' FROM '.strtolower(get_class($this));
                return $query;

            case 'load_multiple':
                //load all attributes
                $obj = strtolower(get_class($this));
                $query = "SELECT * FROM {$obj}";
                return $query;

            case 'update':
                $table_name = strtolower(get_class($this));
                $field_set = "";
                $where ="";
                $obj_vars = get_class_vars($table_name);
                foreach ($obj_vars as $key=>$value){
                    if ($key == 'id') {
                        $where .= "{$key} = {$this->$key}";
                    }else {
                        $field_set .= "{$key} = '{$this->$key}', ";
                    }
                }
                $field_set = substr($field_set, 0, -2);
                $query = "UPDATE {$table_name} SET {$field_set} WHERE {$where}";
                return $query;

            case 'remove':
                //remove value
                $remove_table = get_class($this);
                $where = "";
                $remove_object_vars = get_class_vars($remove_table);
                foreach ($remove_object_vars as $key=>$value){
                    if ($key == 'id'){
                        $where .= "{$key}={$this->$key}";
                    }
                }
                $query = "DELETE FROM {$remove_table} WHERE {$where}";
                return $query;

            case 'find_by':
                //select values by field and value
                $find_by_tables = get_class($this);
                $find_by_field_set ="";
                $find_by_object_vars = get_class_vars($find_by_tables);
                foreach ($find_by_object_vars as $key=>$value){
                    if ($this->$key) $find_by_field_set .= "{$key} = '{$this->$key}' &&";
                }
                $find_by_field_set = substr($find_by_field_set, 0, -3);
                $query = "SELECT * FROM {$find_by_tables} WHERE {$find_by_field_set}";
                return $query;

            default;
        }
    }

}