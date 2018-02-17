<?php
//class extending Member
//<!--Ajwinder Singh-->
//<!--2/1/2018-->
//<!--PremiumMember.php-->


/**The premium member class extends the member class
 *
 * Used to make a primum member
 * getters and setters for intereset included extra
 *
 * Class PremiumMember
 *
 * @author Ajwinder Singh
 * @copyright 2018
 */
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