<?php
//<!--Ajwinder Singh-->
//<!--2/15/2018-->
//<!--Membe.php-->


/**
 * Class Member for a regular member without the premium
 *
 * Takes fname, lname, age, gender and phone.
 * Used to create a regular member
 *
 * @author Ajwinder Singh
 * @copyright 2018
 */
class Member
{
    //fields
    protected $fname;
    protected $lname;
    protected $age;
    protected $gender;
    protected $phone;
    protected $email;
    protected $seeking;
    protected $bio;
    protected $state;

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->age = $age;
        $this->gender = $gender;
        $this->phone = $phone;
    }

    public function getFname()
    {
        return $this->fname;
    }

    public function setFname($fname)
    {
        $this->fname = $fname;
    }


    public function getLname()
    {
        return $this->lname;
    }

    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getPhone()
    {
        return $this->phone;
    }


    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getSeeking()
    {
        return $this->seeking;
    }


    public function setSeeking($seeking)
    {
        $this->seeking = $seeking;
    }


    public function getBio()
    {
        return $this->bio;
    }


    public function setBio($bio)
    {
        $this->bio = $bio;
    }


}