<?php
require_once './models/entities/Phone.php';
require_once './models/DbConnector.php';

class Phones
{
    public function checkDuplicatesPhones($post,$db_phones)
    {

        $phones=$post['phones'];

        if($this->no_dupes($phones))
        {

                    $array=array_intersect($phones,$db_phones);
                    if( $array==null){
                        return true;
                }
                else{

                    return false;
                }


        }
       return false;
    }

    public function checkUserPhone($post)
    {
        $phone=$post['phone'];
        $db = DbConnector::getConnection();
        $result = $db->query( "SELECT * FROM `users_phone` WHERE `phone`='$phone' " );
        if(mysqli_num_rows($result)>0)
            return false;
        else
            return true;
    }

    public function insertUserPhone($id_user,$post)
    {
        $phone=$post['phone'];
        $db = DbConnector::getConnection();
        $result = $db->query(" INSERT INTO `users_phone`( `phone`,`id_users` ) VALUES ('$phone','$id_user') " );
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    public function insertUserPhones($post)
    {
        $phones=$post['phones'];
        session_start();
        $id=$_SESSION['user']['id'];

        $db = DbConnector::getConnection();
        foreach ($phones as $key => $val) {
            $result = $db->query(" INSERT INTO `users_phone`( `phone`,`id_users` ) VALUES ('$val','$id') ");
        }
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    public function editUserPhones($post)
    {
        $c=0;
        $phones=$post['phones'];
        session_start();
        $id=$_SESSION['user']['id'];
        $id_phones=array_values($_SESSION['user']['phones']);

        $db = DbConnector::getConnection();
        foreach ($phones as $key => $val) {
            $result = $db->query(" UPDATE `users_phone` SET `phone`='$val' WHERE `users_phone`.`id`='$id_phones[$c]' AND `id_users`='$id' ");
            $c++;
        }
        if($result){
            $answer=array("status"=>'True');
            return json_encode($answer);

        }
        else{
            $answer=array("status"=>'False');
            return json_encode($answer);
        }
    }

    public function getAllPhonesUsers()
    {
        session_start();
        $id_user=$_SESSION['user']['id'];

        $db = DbConnector::getConnection();

        $queryResult=  $db->query("SELECT * FROM `users_phone`WHERE `users_phone`.`id_users`='$id_user' ");
        $phones = array();
        $phonesid=array();
        while ($row = $queryResult->fetch_assoc()) {
            $phone = new Phone(
                $row["id"],
                $row["id_users"],
                $row["phone"]
            );
            array_push($phonesid, $row["id"]);
            array_push($phones, $phone);
            session_start();
            $_SESSION['user']['phones']=$phonesid;
        }

        return $phones;

    }

    public function getAllPhones()
    {
        $db = DbConnector::getConnection();

        $queryResult=  $db->query("SELECT `users_phone`.`phone` FROM `users_phone`  ");
        $db_phones = array();
        while ($row = $queryResult->fetch_assoc()) {
           array_push($db_phones,$row['phone']);
        }

        return $db_phones;
    }

    public function getOtherPhones(){
        session_start();
        $id_user=$_SESSION['user']['id'];

        $db = DbConnector::getConnection();

        $queryResult=  $db->query("SELECT `users_phone`.`phone` FROM `users_phone`  WHERE `id_users`!='$id_user'");
        $db_phones = array();
        while ($row = $queryResult->fetch_assoc()) {
            array_push($db_phones,$row['phone']);
        }

        return $db_phones;
    }

   private function no_dupes(array $input_array)
   {
        return count($input_array) === count(array_flip($input_array));
    }
}