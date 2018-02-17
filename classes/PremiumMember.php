<!--Ajwinder Singh-->
<!--2/14/2018-->
<!--validateProfile.php-->
<!--Premium Member class-->
<?php
//class extending Member
class PremiumMember extends Member
{
    private $_indoor;
    private $_outdoor;

    function __construct($fname, $lname, $age, $gender, $phone)
    {
        //passing to parent constructor
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }


    //additional getters and setters
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