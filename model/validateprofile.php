<?php

function validState($state)
{
    global $f3;
    return in_array($state, $f3->get('states'));
}

if (!validState($state))
{
    $errors['state'] = "Enter a valid state";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $errors['email'] = "Enter a valid email";
}

if ($seeking != "Female" && $seeking != "Male")
{
    $errors['seeking'] = "Select one";
}
$bio = trim($bio);

if (empty($bio))
{
    $errors['bio'] = "Add bio";
}




$success = sizeof($errors) == 0;