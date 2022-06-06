<?php
require_once './models/entities/User.php';
require_once './models/DbConnector.php';

class Users
{

    public function getUserByLoginPassword($post){

        $login = $post['login'];
        $password = md5($post['password']);

        $db = DbConnector::getConnection();

        $queryResult =  $db->query( "SELECT * FROM `users` WHERE login='$login' AND password='$password'");

        if (mysqli_num_rows($queryResult) == 0) {
            $answer=array("status"=>'False');
            return json_encode($answer);
        }
        else{
            $row = $queryResult->fetch_assoc();
            $random = $this->genString($row);
            $db->query("UPDATE `users` SET `auth_string`='$random' WHERE `id`='$row[id]'");
            $answer=true;
            return json_encode($answer);
        }
    }

    private function genString($row){
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $strlength = strlen($characters);
        $random = '';
        for ($i = 0; $i < 64; $i++) {
            $random .= $characters[rand(0, $strlength - 1)];
        }
        session_start();
        $_SESSION['user']['id']=$row["id"];
        $_SESSION['user']['login']=$row["login"];
        $_SESSION['user']['password']=$row["password"];
        $_SESSION['user']['name']=$row["name"];
        $_SESSION['user']['email']=$row["email"];
        $_SESSION['user']['auth_string']=$random;

        return $random;
    }

    public function checkEmailUser($post)
    {
         session_start();
         $id= $_SESSION['user']['id'];
        $email=$post['email'];

        $db = DbConnector::getConnection();
        $queryResult = $db->query( "SELECT COUNT(email) FROM `users` WHERE `users`.`email`='$email' AND `id`!='$id' " );

        $row = $queryResult->fetch_assoc();

        if($row["COUNT(email)"]==0)
            return false;
        else
            return true;
    }

    public  function checkLoginEmailUser($post){
        $email=$post['email'];
        $login=$post['login'];

        $db = DbConnector::getConnection();
        $result = $db->query( "SELECT * FROM `users` WHERE `login`='$login' OR `email`='$email'" );

        if(mysqli_num_rows($result)>0)
            return false;
        else
            return true;
    }

    public function exit(){
        session_start();
        $id= $_SESSION['user']['id'];

        $db = DbConnector::getConnection();
        $result = $db->query( "UPDATE `users` SET `auth_string`=null  WHERE `id`='$id' " );
        if($result)
            $_SESSION['user']['auth_string']=null;
    }

    public function registedNewUser($post)
    {
        $login = $post['login'];
        $password = md5($post['password']);
        $email=$post['email'];
        $name=$post['name'];

        $db = DbConnector::getConnection();
        $result = $db->query(" INSERT INTO `users`(`name`, `login`, `password`, `email`) VALUES ('$name','$login','$password','$email') " );
        var_dump($result);
        if($result){
            $queryResult= $db->query( "SELECT `users`.`id` FROM `users` WHERE `login`='$login' AND `email`='$email' " );

            $row = $queryResult->fetch_assoc();
            return $row['id'];
        }
        else{
            return 0;
        }
    }

    public function editUser($post)
    {

        $id=$post['id'];
        $email=$post['email'];
        $name=$post['name'];

        $db = DbConnector::getConnection();
        $result = $db->query( "UPDATE `users` SET `name`='$name',`email`='$email' WHERE `id`='$id' " );

        if($result){
            session_start();
            $_SESSION['user']['name']=$name;
            $_SESSION['user']['email']=$email;
            return true;
        }
        else{
            return false;
        }
    }
}