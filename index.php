<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
//Require the autoload file
require_once('vendor/autoload.php');

include ('classes/Member.php');
include ('classes/PremiumMember.php');
//Create an instance of the Base Class
$f3 = Base :: instance();

//Set debug level
//will take care of php errors as well which gives 500 error
$f3->set('DEBUG', 3);

session_start();


$f3->set('indoor', array('tv', 'movies', 'cooking', 'board games', 'puzzles', 'reading', 'playing cards', 'video games'));
$f3->set('outdoor', array('hiking', 'biking', 'swimming', 'collecting', 'walking', 'climbing'));
$f3->set('states',array('Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','District of Columbia','Florida',
    'Georgia','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota',
    'Mississippi','Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York','North Carolina','North Dakota',
    'Ohio','Oklahoma','Oregon','Pennsylvania', 'Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont',
    'Virginia','Washington','West Virginia','Wisconsin','Wyoming'));

//Define a default route
$f3->route('GET /', function($f3)
{
    $template = new Template();
    echo $template->render('pages/home.html');

});

$f3->route('GET|POST /personalInfo', function($f3)
{
    if (isset($_POST['submit']))
    {
        //print_r($_POST);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $pnumber = $_POST['pnumber'];
        $premium = $_POST['premium'];

        require ('model/validate.php');

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
            if ($premium == 'yes')
            {
                $premiumMember = new PremiumMember($fname,$lname,$age,$gender,$pnumber);
                $_SESSION['Member'] = $premiumMember;
                header("Location: http://asingh.greenriverdev.com/328/dating/profile");
            }
            else
            {
                $Member = new Member($fname,$lname,$age,$gender,$pnumber);
                $_SESSION['Member'] = $Member;
                header("Location: http://asingh.greenriverdev.com/328/dating/profile");
            }

            $_SESSION['premium'] = $premium;

            //header("Location: http://asingh.greenriverdev.com/328/dating/profile");
        }
    }
    $template = new Template();
    echo $template->render('pages/personalInformation.html');

});


$f3->route('GET|POST /profile', function($f3)
{
    if (isset($_POST['submit']))
    {
        //print_r($_POST);
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $bio = $_POST['bio'];


        require ('model/validateprofile.php');

        $f3->set('email',$email);
        $f3->set('stateselect',$state);
        $f3->set('seeking',$seeking);
        $f3->set('bio',$bio);
        $f3->set('success',$success);
        $f3->set('errors', $errors);

        if($success)
        {
            $Member = $_SESSION['Member'];
            $Member->setBio($bio);
            $Member->setEmail($email);
            $Member->setSeeking($seeking);
            $_SESSION['Member'] = $Member;
            if ($_SESSION['premium'] == 'yes')
            {
                header("Location: http://asingh.greenriverdev.com/328/dating/interests");
            }
            else
            {
                header("Location: http://asingh.greenriverdev.com/328/dating/summary");
            }
        }
    }

    $template = new Template();
    echo $template->render('pages/profile.html');

});

$f3->route('GET|POST /interests', function($f3)
{
    if (isset($_POST['submit']))
    {

        $out = $_POST['outdoors'];
        $in = $_POST['indoors'];

        require ('model/validAct.php');

        $f3->set('out',$out);
        $f3->set('in',$in);
        $f3->set('success',$success);
        $f3->set('errors', $errors);

        $Member = $_SESSION['Member'];
        $Member->setOutdoor($out);
        $Member->setIndoor($in);
        //print_r($Member);
        if ($success)
        {
            $_SESSION['Member'] = $Member;
            header("Location: http://asingh.greenriverdev.com/328/dating/summary");
        }

    }

    $template = new Template();
    echo $template->render('pages/interests.html');

});

$f3->route('GET|POST /summary', function($f3)
{
    $Member = $_SESSION['Member'];
    $f3->set('fname', $Member->getFname());
    $f3->set('lname', $Member->getLname());
    $f3->set('age', $Member->getAge());
    $f3->set('gender', $Member->getGender());
    $f3->set('pnumber', $Member->getPhone());
    $f3->set('email', $Member->getEmail());
    $f3->set('seeking', $Member->getSeeking());
    $f3->set('bio', $Member->getBio());
    if ($_SESSION['premium'] == 'yes')
    {
        $f3->set('out', $Member->getOutdoor());
        $f3->set('in', $Member->getIndoor());
    }
    $template = new Template();
    echo $template->render('pages/summary.html');

});


//Run fat free
$f3->run();