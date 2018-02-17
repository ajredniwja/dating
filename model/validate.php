<!--Ajwinder Singh-->
<!--2/1/2018-->
<!--validate.php-->
<!--validate personalinfo page-->
<?php
//checks if the first name is empty or not
//also if it has valid string
function validName($fname)
{
    return !empty($fname) && ctype_alpha($fname);
}

validName($lname);

//function to validate age
function validAge($age)
{
    return is_numeric($age) && ($age >= 18);
}

//function to validate phone number
function validPhone($pnumber)
{
    //$pnumber = preg_replace("/{[-:; /", "", $pnumber);
    return is_numeric($pnumber) && strlen($pnumber)  <= 10;
}

//setting errors
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

if ($gender != "Female" && $gender != "Male")
{
    $errors['gender'] = "Select one";
}


$success = sizeof($errors) == 0;