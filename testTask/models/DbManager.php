<?php
require_once './models/tables/Users.php';
require_once './models/tables/Phones.php';

class DbManager
{
public $Users;
public $Phones;

    /**
     * DbManager constructor.
     * @param $Users
     * @param $Phones
     */
    public function __construct()
    {
        $this->Users = new Users();
        $this->Phones = new Phones();
    }
}