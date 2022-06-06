<?php
require_once './views/View.php';

class PagesController
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function indexAction(){
        $this->view->render("main","pages/index");

    }
}
