<?php
//<!--Ajwinder Singh-->
//<!--2/15/2018-->
//<!--Membe.php-->


/**
 * Class Member for a regular member without the premium
 *
 * This calss takes fname, lname, age, gender and phone.
 * This calss is used to create a regular member.
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
     * This is a Member class constructor that is used to make an object.
     *
     * @param $fname first name
     * @param $lname last name
     * @param $age age
     * @param $gender gender
     * @param $phone phone
     */
    function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->age = $age;
        $this->gender = $gender;
        $this->phone = $phone;
    }

    /**Getter for state, gets state
     *
     * @return state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * setter for state, gets state
     * @param  $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**Getter for first name, gets first name
     *
     * @return first name
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Setter to set the firstname
     * @param $fname
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
    }

    /**
     * getter to get the last name
     *
     * @return last name
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * setter to set the last name
     * @param $lname
     */
    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    /**
     * getter to get the age
     * @return age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * setter to set the age,
     * this sets the age only if its numeric and non negative.
     * @param $age
     */
    public function setAge($age)
    {
        //set age to null if age is negatice and not numeric
        if ($age < 0)
        {
            if (!is_numeric($age))
            {
                $this->age = null;
            }
        }
        else
        {
            $this->age = $age;
        }
    }

    /**
     * getter to get the gender
     * @return gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * setter to set the gender
     * @param $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * getter to get the phone
     * @return phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * setter to set the phone number.
     * sets the phone number if the length is more the 7 digits, null otherwise
     * @param $phone
     */
    public function setPhone($phone)
    {
        //set to null if less than 7 digits
        if (strlen($phone) < 7)
        {
            $this->phone = null;
        }
        else
        {
            $this->phone = $phone;
        }
    }

    /**
     * getter to get the email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * setter to set the email
     * sets only if it is less than 30 characters
     * otherwise sets the default value to "bad email"
     * @param $email
     */
    public function setEmail($email)
    {
        //set to 'bad email' if more than 30 chars
        if (strlen($email) > 30)
        {
            $this->email = "Bad email";

        }
        else
        {
            $this->email = $email;
        }
    }


    /**
     * getter to get the seeking male or female
     * @return seeking
     */
    public function getSeeking()
    {
        return $this->seeking;
    }


    /**
     * setter to set the seeking
     * @param $seeking
     */
    public function setSeeking($seeking)
    {
        $this->seeking = $seeking;
    }


    /**
     * getter to get the bio
     * @return bio
     */
    public function getBio()
    {
        return $this->bio;
    }

    /** setter to set the bio,
     * set only if it has atleast 41 characters, null otherwise
     * @param $bio
     */
    public function setBio($bio)
    {
        //set to empty if < 40
        if (strlen($bio) < 40)
        {
            $this->bio = "";
        }
        else
        {
            $this->bio = $bio;

        }
    }


}