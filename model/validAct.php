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

if (!validIndoor($indoor))
{
    $errors['indoore'] = "Enter a valid state";
}

if (!validOutdoor($outdoor))
{
    $errors['outdoore'] = "Enter a valid state";
}