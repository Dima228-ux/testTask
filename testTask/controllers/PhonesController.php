<?php
require_once './models/DbManager.php';
require_once './views/View.php';

class PhonesController
{
    private $dbManager;
    private $view;

    public function __construct()
    {
        $this->dbManager = new DbManager();
        $this->view = new View();
    }

    public function addPhonesFormAction()
    {
        session_start();
        if($_SESSION['user']['auth_string']==null)
            $this->view->redirect("/testtask/users/registrationsForm");
        else
        $this->view->render("main", "phones/addPhonesForm");
    }

    public function addPhonesAction($post)
    {
        session_start();
        if($_SESSION['user']['auth_string']==null)
            $this->view->redirect("/testtask/users/registrationsForm");
        else {
            $db_phones = $this->dbManager->Phones->getAllPhones();
            $answer = $this->dbManager->Phones->checkDuplicatesPhones($post, $db_phones);
            echo $answer;
            if ($answer) {

                if ($this->dbManager->Phones->insertUserPhones($post)) {
                    $session = $this->dbManager->Phones->getAllPhonesUsers();
                    $this->view->redirect("/testtask/users/editProfileForm");
                }
            } else {
                $this->addPhonesFormAction();
            }
        }
    }
}