<!--Ajwinder Singh-->
<!--2/1/2018-->
<!--validateProfile.php-->
<!--validates profile page-->
<?php

//checks if the state is in states array or not
function validState($state)
{
    global $f3;
    return in_array($state, $f3->get('states'));
}

//set errors
if (!validState($state))
{
    $errors['state'] = "Enter a valid state";
}

//validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $errors['email'] = "Enter a valid email";
}

//validate seeking and set errors
if ($seeking != "Female" && $seeking != "Male")
{
    $errors['seeking'] = "Select one";
}
$bio = trim($bio);

//validate bio
if (empty($bio))
{
    $errors['bio'] = "Add bio";
}




$success = sizeof($errors) == 0;