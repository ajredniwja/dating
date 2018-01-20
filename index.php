<?php
//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base Class
$f3 = Base :: instance();

//Set debug level
//will take care of php errors as well which gives 500 error
$f3->set('DEBUG', 3);

//Define a default route
$f3->route('GET /', function ()
{
    $view = new View;
    echo $view->render
    ('pages/home.html');
    //echo '<h1>Hello, world!</h1>';
}
);

//Run fat free
$f3->run();