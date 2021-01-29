<?php
// TThis is my CONTROLLER

//Turn on Error reporting
ini_set('display_errors',TRUE);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');

// Create an instance of the Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);


//Define a default route (home page of our application)
$f3->route('GET /', function (){
    // echo " My Food Page";
    $view = new Template();
    echo $view->render('views/home.html');

});

// Run fat free
$f3->run();
