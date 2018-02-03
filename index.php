<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
//Require the autoload file
require_once('vendor/autoload.php');
session_start();

//Create an instance of the Base Class
$f3 = Base :: instance();

//Set debug level
//will take care of php errors as well which gives 500 error
$f3->set('DEBUG', 3);

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
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['gender'] = $gender;
            $_SESSION['age'] = $age;
            $_SESSION['pnumber'] = $pnumber;


            header("Location: http://asingh.greenriverdev.com/328/dating/profile");
        }
    }
    $template = new Template();
    echo $template->render('pages/personalInformation.html');

});


$f3->route('GET|POST /profile', function($f3)
{
    if (isset($_POST['submit']))
    {
        print_r($_POST);
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
            $_SESSION['email'] = $email;
            $_SESSION['seeking'] = $seeking;
            $_SESSION['bio'] = $bio;
            header("Location: http://asingh.greenriverdev.com/328/dating/interests");
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
        //print_r($errors);
        if ($success)
        {
            $_SESSION['out'] = $out;
            $_SESSION['in'] = $in;
            header("Location: http://asingh.greenriverdev.com/328/dating/summary");
        }

    }

    $template = new Template();
    echo $template->render('pages/interests.html');

});

$f3->route('GET|POST /summary', function($f3)
{
    $f3->set('fname', $_SESSION['fname']);
    $f3->set('lname', $_SESSION['lname']);
    $f3->set('age', $_SESSION['age']);
    $f3->set('gender', $_SESSION['gender']);
    $f3->set('pnumber', $_SESSION['pnumber']);
    $f3->set('email', $_SESSION['email']);
    $f3->set('seeking', $_SESSION['seeking']);
    $f3->set('interests', $_SESSION['interests']);
    $f3->set('bio', $_SESSION['bio']);
    $f3->set('out', $_SESSION['out']);
    $f3->set('in', $_SESSION['in']);

    $template = new Template();
    echo $template->render('pages/summary.html');

});


//Run fat free
$f3->run();