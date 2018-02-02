<?php

function validName($fname)
{
    return !empty($fname) && ctype_alpha($fname);
}

validName($lname);

function validAge($age)
{
    return is_numeric($age) && ($age >= 18);
}

function validPhone($pnumber)
{
    //$pnumber = preg_replace("/{[-:; /", "", $pnumber);
    return is_numeric($pnumber) && strlen($pnumber)  <= 10;
}

function validOutdoor($out, $outdoor)
{
    //return in_array($out, $outdoor);
}

function validIndoor($in, $indoor)
{
    //return in_array($in, $indoor);
}

if(!validName($fname))
{
    $errors['fname'] = "Please enter a valid First Name";
}

if(!validName($lname))
{
    $errors['lname'] = "Please enter a valid Last Name";
}


if(!validAge($age))
{
    $errors['age'] = "Please enter a valid age";
}

if(!validPhone($pnumber))
{
    $errors['pnumber'] = "Please enter a valid Phone Number";
}

//if(!validOutdoor($out, $outdoor))
//{
//    $errors['out'] = "Please select Valid activity";
//}
//if(!validAge($in, $indoor))
//{
//    $errors['in'] = "Please select Valid activity";
//}

$success = sizeof($errors) == 0;