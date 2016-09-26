<?php
/**
 * Created by PhpStorm.
 * User: tsuyogbasnet
 * Date: 7/21/16
 * Time: 12:56 PM
 */
class ArticleController extends Controller {

    public function index(){
        //$article = new Article();
        $page = new Page();
        $find_by = array('id'=> 4);
        $page->bind($find_by);
        //$data['article'] = $article->load_multiple();
        $data['page'] = $page->findBy();
    }
}