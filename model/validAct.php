<?php
function validOutdoor($out)
{
    global $f3;
    return in_array($out, $f3->get('outdoor'));
}

function validIndoor($in)
{
    global $f3;
    return in_array($in, $f3->get('indoor'));
}

if (!isset($in))
{
    $errors['indoore'] = "Select atleast one indoor activity!";
}

if (!isset($out))
{
    $errors['outdoore'] = "Select atleast one indoor activity!";
}
$success = sizeof($errors) == 0;

