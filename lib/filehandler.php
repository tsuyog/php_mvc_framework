<?php
/**
 * Created by PhpStorm.
 * User: tsuyogbasnet
 * Date: 7/19/16
 * Time: 12:43 PM
 */
class FileHandler {
    //arguments; file data and directory
    public static  function uploadUserFile($data){
        //check whether the directory exist or not
        //change it later with algo
        $dir = ROOT.DS.'public'.DS.'user_folder'.DS.'images';
        //needs to check fiel type, means video or image
        $directory_does_exist = true;
        if (!$directory_does_exist){
            //get user_name or info;
            $username = 'test_user';
            $create_dir = mkdir(ROOT.DS.'public'.DS.$username, 07000);
            if($create_dir){
                //procede to upload
            }else {
                throw new Exception('unable to create the directory for the user: '.$username);
            }
        }
    }

}