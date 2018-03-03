<?php
//class extending Member
//<!--Ajwinder Singh-->
//<!--2/1/2018-->
//<!--PremiumMember.php-->


/**The premium member class extends the member class
 *
 * This class is used to make a primum member
 * In this class getters and setters for interests are included extra
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

    /**
     * PremiumMember constructor for premium members which passes basic params to thhe parent class.
     * @param first name
     * @param last name
     * @param age
     * @param gender
     * @param phone number
     */
    function __construct($fname, $lname, $age, $gender, $phone)
    {
        //passing to parent constructor
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }


    //additional getters and setters

    /**
     * getter to get indoor interests
     * @return indoor interests
     */
    public function getIndoor()
    {
        return $this->_indoor;
    }


    /**
     * setter to set the indoor interests
     * @param $indoor
     */
    public function setIndoor($indoor)
    {
        $this->_indoor = $indoor;
    }


    /**
     * getter to get the outdoor interests
     * @return outdoor interests
     */
    public function getOutdoor()
    {
        return $this->_outdoor;
    }

    /**
     * setter to set the outdoor interests
     * @param $outdoor
     */
    public function setOutdoor($outdoor)
    {
        $this->_outdoor = $outdoor;
    }

}