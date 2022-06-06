<?php


class User
{
    public $Id;
    public $Login;
    public $Password;
    public $Email;


    /**
     * User constructor.
     * @param $Id
     * @param $Login
     * @param $Password
     * @param $Email
     * @param $Phone
     */
    public function __construct($Id, $Login, $Password, $Email, $Phone)
    {
        $this->Id = $Id;
        $this->Login = $Login;
        $this->Password = $Password;
        $this->Email = $Email;

    }

}