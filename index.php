<?php
//Ajwinder Singh
//3/2/2018
//index.php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);

//Require the files
require_once('vendor/autoload.php');
//require config file
require_once('/home/asinghgr/config.php');

//start a session
session_start();

//Create an instance of the Base Class
$f3 = Base :: instance();

//Set debug level
//will take care of php errors as well which gives 500 error
$f3->set('DEBUG', 3);
//start the session

//making arrays
$f3->set('indoor', array('tv', 'movies', 'cooking', 'board games', 'puzzles', 'reading', 'playing cards', 'video games'));
$f3->set('outdoor', array('hiking', 'biking', 'swimming', 'collecting', 'walking', 'climbing'));
$f3->set('states',array('Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','District of Columbia','Florida',
    'Georgia','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota',
    'Mississippi','Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York','North Carolina','North Dakota',
    'Ohio','Oklahoma','Oregon','Pennsylvania', 'Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont',
    'Virginia','Washington','West Virginia','Wisconsin','Wyoming'));

//make dbfunctions class object
$database = new Dbfunctions();

//call connect function from dbfunctions class to connect to the database
$dbh = $database->connect();

//Define a default route
$f3->route('GET /', function($f3)
{
    $template = new Template();
    echo $template->render('pages/home.html');

});

//personal info route
$f3->route('GET|POST /personalInfo', function($f3)
{
    //if submit hit
    if (isset($_POST['submit']))
    {
        //geting data from the form and setting it to the variables
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $pnumber = $_POST['pnumber'];
        $premium = $_POST['premium'];

        //require to validate fields
        require ('model/validate.php');

        //setting the fatfree variables(key value pairs)
        $f3->set('fname',$fname);
        $f3->set('lname',$lname);
        $f3->set('age',$age);
        $f3->set('gender',$gender);
        $f3->set('pnumber',$pnumber);
        $f3->set('success',$success);
        $f3->set('errors', $errors);
        //print_r($_POST);
        if($success)
        {
            //if premium membership
            if ($premium == 'yes')
            {
                //making an object
                $premiumMember = new PremiumMember($fname,$lname,$age,$gender,$pnumber);
                $_SESSION['Member'] = $premiumMember; //assigning it to a session variable
                header("Location: http://asingh.greenriverdev.com/328/dating/profile");
            }
            else
            {
                //making an object
                $Member = new Member($fname,$lname,$age,$gender,$pnumber);
                $_SESSION['Member'] = $Member; //assigning it to session varriable
                header("Location: http://asingh.greenriverdev.com/328/dating/profile");
            }

            $_SESSION['premium'] = $premium; //setting premium to session variable

        }
    }
    //rendering the template
    $template = new Template();
    echo $template->render('pages/personalInformation.html');

});


$f3->route('GET|POST /profile', function($f3)
{
    if (isset($_POST['submit']))
    {
        //geting data from the form
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $bio = $_POST['bio'];

        //require to validate fields
        require ('model/validateprofile.php');

        //setting the fatfree variables(key value pairs)
        $f3->set('email',$email);
        $f3->set('stateselect',$state);
        $f3->set('seeking',$seeking);
        $f3->set('bio',$bio);
        $f3->set('success',$success);
        $f3->set('errors', $errors);

        if($success)
        {
            //Getting object from session variable
            $Member = $_SESSION['Member'];
            //setters to set fields
            $Member->setBio($bio);
            $Member->setEmail($email);
            $Member->setSeeking($seeking);
            $Member->setState($state);
            //putting to session variable again
            $_SESSION['Member'] = $Member;
            if ($_SESSION['premium'] == 'yes')
            {
                //show interests page if premium
                header("Location: http://asingh.greenriverdev.com/328/dating/interests");
            }
            else
            {
                //no premium
                header("Location: http://asingh.greenriverdev.com/328/dating/summary");
            }
        }
    }

    //render the template
    $template = new Template();
    echo $template->render('pages/profile.html');

});

$f3->route('GET|POST /interests', function($f3)
{
    //uplaoding image
    $target_dir = "images/uploads/";
    $target_file = $target_dir.basename($_FILES["imgfile"]["name"]);
    $uploadok = 1;
    $imgType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    echo $imgType;

    if (isset($_POST['submit']))
    {

        //geting data from form
        $out = $_POST['outdoors'];
        $in = $_POST['indoors'];

        //require to validate
        require ('model/validAct.php');
        move_uploaded_file($_FILES["imgfile"]["tmp_name"],$target_file);

        echo "The file " . basename($_FILES["imgfile"]["name"]). "hass been uploaded";


        $f3->set('out',$out);
        $f3->set('in',$in);
        $f3->set('success',$success);
        $f3->set('errors', $errors);

        //object from session variable
        $Member = $_SESSION['Member'];
        $Member->setOutdoor($out); //setters to set fields
        $Member->setIndoor($in);
        //if no errors
        if ($success)
        {
            //re assign the session variable
            $_SESSION['Member'] = $Member;
            header("Location: http://asingh.greenriverdev.com/328/dating/summary");
        }

    }
    //render
    $template = new Template();
    echo $template->render('pages/interests.html');

});

$f3->route('GET /admin', function($f3, $params) {

    $database = new Dbfunctions();

    //print_r($_SESSION);
    $members = $database->getMembers();
    $f3->set('members', $members);

    $template = new Template();
    echo $template->render('pages/admin.html');

});

//summary page
$f3->route('GET|POST /summary', function($f3)
{
    //make object from session variable
    $Member = $_SESSION['Member'];

    $image = "Not provided";

    //setting fatfree variables usung getters
    $f3->set('fname', $Member->getFname());
    $f3->set('lname', $Member->getLname());
    $f3->set('age', $Member->getAge());
    $f3->set('gender', $Member->getGender());
    $f3->set('pnumber', $Member->getPhone());
    $f3->set('email', $Member->getEmail());
    $f3->set('seeking', $Member->getSeeking());
    $f3->set('bio', $Member->getBio());



    if ($_SESSION['premium'] !== 'yes')
    {
        $database = new Dbfunctions();
        $premium = 0;
        //interests == "" here
        $database->insertStudent($memberID, $Member->getFname(), $Member->getLname(), $Member->getAge(), $Member->getGender(), $Member->getPhone(), $Member->getEmail(), $Member->getState(), $Member->getSeeking(), $Member->getBio(), $premium, $image, "N/A");
    }



    if ($_SESSION['premium'] == 'yes')
    {
        //initiate a variable
        $interest = "";

        $database = new Dbfunctions();
        $premium = 1;
        //only set if premium is checked
        $f3->set('out', $Member->getOutdoor());
        $f3->set('in', $Member->getIndoor());
        $f3->set('pm', 'yes');

        //merge indoor and outdoor array
        $interests = array_merge($Member->getOutdoor(),$Member->getIndoor());
        ///concatenate all the elements in the array
        foreach ($interests as $in)
        {
            $interest.=$in.", ";
        }
        //interests is the result from above merged array
        $database->insertStudent($memberID, $Member->getFname(), $Member->getLname(), $Member->getAge(), $Member->getGender(), $Member->getPhone(), $Member->getEmail(), $Member->getSTate(), $Member->getSeeking(), $Member->getBio(), $premium, $image, $interest);
    }
    //render
    $template = new Template();
    echo $template->render('pages/summary.html');

});

//Define a summary route
$f3->route('GET /admin/@fname', function($f3, $params) {

    //dbfunctions object
    $database = new Dbfunctions();
    $sid = $params['fname'];
    //call getMember function
    $member = $database->getMember($sid);
    $f3->set('member', $member);

    //render
    $template = new Template();
    echo $template->render('pages/view-member.html');

});


//Run fat free
$f3->run();