<?php
class PremiumMember extends Member
{
    private $_indoor;
    private $_outdoor;

    function __construct($fname, $lname, $age, $gender, $phone)
    {
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }


    public function getIndoor()
    {
        return $this->_indoor;
    }


    public function setIndoor($indoor)
    {
        $this->_indoor = $indoor;
    }


    public function getOutdoor()
    {
        return $this->_outdoor;
    }

    public function setOutdoor($outdoor)
    {
        $this->_outdoor = $outdoor;
    }

}