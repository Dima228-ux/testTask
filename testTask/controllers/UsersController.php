<?php
require_once './models/DbManager.php';
require_once './views/View.php';

class UsersController
{

    private $dbManager;
    private $view;


    public function __construct()
    {

        $this->dbManager = new DbManager();
        $this->view = new View();

    }

    public function editProfileFormAction()
    {
      $session=  $this->dbManager->Phones->getAllPhonesUsers();
        $this->view->render("main", "users/editProfileForm",$session);
    }

    public function editProfileAction($post)
    {
        session_start();
         if($_SESSION['user']['auth_string']==null)
             $this->view->redirect("/testtask/users/registrationsForm");
         else {
             $answer = $this->dbManager->Users->checkEmailUser($post);
             $db_phones = $this->dbManager->Phones->getOtherPhones();
             $chek = $this->dbManager->Phones->checkDuplicatesPhones($post, $db_phones);

             if (!$answer && $chek) {
                 if ($this->dbManager->Phones->editUserPhones($post))

                     $this->dbManager->Users->editUser($post);
                 $this->editProfileFormAction();

             }
         }
        $this->editProfileFormAction();
    }

    public function registrationsFormAction()
    {
        $this->dbManager->Users->exit();
        $this->view->render("main", "users/registrationsForm");
    }

    public function registrationsAction($post)
    {

       echo $this->dbManager->Users->getUserByLoginPassword($post);

    }

    public function loginFormAction()
    {

        $this->view->render("main", "users/loginForm");
    }

    public function loginAction($post)
    {

        $answer = $this->dbManager->Users->checkLoginEmailUser($post);

        $check=$this->dbManager->Phones->checkUserPhone($post);


        if ($answer&&$check){
           $id_user= $this->dbManager->Users->registedNewUser($post);

            if($id_user!=0){
                $this->dbManager->Phones->insertUserPhone($id_user,$post);
                $this->registrationsFormAction();
            }

        }
        else {

            $this->view->render("main", "users/loginForm");
        }
    }
}