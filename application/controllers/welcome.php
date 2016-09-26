<?php

/**
 * Created by PhpStorm.
 * User: tsuyogbasnet
 * Date: 7/16/16
 * Time: 4:40 PM
 */
class WelcomeController extends Controller {
    public function index(){
        $page = new Page();
        //add function
        /*$data = array('alias'=>'New alias', 'title'=>"New title's",'content'=>'New content', 'is_published'=>FALSE);
        $page->bind($data);
        if ($page->add()){
            $pages = $page->load_multiple();
            foreach ($pages as $page){
                echo $page->id;
                echo "<br/>";
                echo $page->alias;
                echo "<br/>";
            }
        }*/
       /* $data = array('id' => 3, 'alias'=>'update alias', 'title'=>'Update title','content'=>'Update content', 'is_published'=>TRUE);
        $page->bind($data);
        $update = $page->update();
        if ($update){
            $pages = $page->load_multiple();
            foreach ($pages as $page){
                echo $page->id;
                echo "<br/>";
                echo $page->alias;
                echo "<br/>";
            }
            echo 'operation completed';
        }*/
        //$page->add();
        //$data = $page->load(array('title', 'content'));
        //echo '<pre/>';
        //print_r($data);

        //$page->update(3, $data);
        //delete operation
        /*$data = array('id'=> 3);
        $page->bind($data);
        if($page->remove()){
            $pages = $page->load_multiple();
            foreach ($pages as $page){
                echo $page->id;
                echo "<br/>";
                echo $page->alias;
                echo "<br/>";
            }
        }*/

        //find by example
        /*$data = array('is_published'=> 1, 'title'=> 'About');
        $page->bind($data);
        $raw = $page->findBy();
        echo "<pre/>";
        print_r($raw);*/
    }

    public function view(){
        echo "this is view function from Welcome controller";
        /*$params = App::getRouter()->getParams();
        if ($params[0]){
            $test_param = $params[0];
            $this->data['content'] = "this is test params for view action: " .$test_param;
        }*/
    }
}
{

}
