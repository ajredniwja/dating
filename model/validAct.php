<!--Ajwinder Singh-->
<!--2/1/2018-->
<!--validAct.php-->
<!--validates interests page-->
<?php
//returns if element is in the array or not
function validOutdoor($out)
{
    global $f3;
    return in_array($out, $f3->get('outdoor'));
}

//returns if element is in the array or not

function validIndoor($in)
{
    global $f3;
    return in_array($in, $f3->get('indoor'));
}

//settings errors
if (!isset($in))
{
    $errors['indoore'] = "Select atleast one indoor activity!";
}

if (!isset($out))
{
    $errors['outdoore'] = "Select atleast one indoor activity!";
}
$success = sizeof($errors) == 0;

