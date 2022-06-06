<?php


class Phone
{
    public $Id;
    public $IdUser;
    public $Phone;

    /**
     * Phone constructor.
     * @param $Id
     * @param $IdUser
     * @param $Phone
     */
    public function __construct($Id, $IdUser, $Phone)
    {
        $this->Id = $Id;
        $this->IdUser = $IdUser;
        $this->Phone = $Phone;
    }
}