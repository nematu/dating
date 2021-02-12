<?php
// Controller for the Dating site "My Moon"
// Date: 02/11/2021
// Nematullah Ayaz Akhundzada


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base Class
$f3 = Base::instance();
$f3->set('DEBUG', 3);


$f3->route('GET /', function ($f3) {
    $f3->set('title', 'Adventure Date!');

    $view = new Template();
    echo $view->render('views/home.html');
});


$f3->route('GET|POST /personal', function ($f3) {
    $f3->set('title', 'Profile Creation');

    $view = new Template();
    echo $view->render('views/personal.html');
});



$f3->route('POST|GET /profile', function ($f3) {
    $f3->set('title', 'Profile Creation');


    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if(isset($_POST['fname']))
        {
            $_SESSION['fname'] = $_POST['fname'];
        }
        if(isset($_POST['lname']))
        {
            $_SESSION['lname'] = $_POST['lname'];
        }

        if(isset($_POST['age']))
        {
            $_SESSION['age'] = $_POST['age'];
        }

        if(isset($_POST['phone']))
        {
            $_SESSION['phone'] = $_POST['phone'];
        }

        if(isset($_POST['gender']))
        {
            foreach($_POST['gender'] as $gender)
            {
                $_SESSION['gender'] = $gender;
            }
        }
    }

    $view = new Template();
    echo $view->render('views/profile.html');
});



$f3->route('POST|GET /interest', function ($f3) {
    $f3->set('title', 'Profile Creation');


    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        if(isset($_POST['email']))
        {
            $_SESSION['email'] = $_POST['email'];
        }

        if(isset($_POST['state']))
        {
            $_SESSION['state'] = $_POST['state'];
        }

        if(isset($_POST['gender2']))
        {
            foreach($_POST['gender2'] as $gender2)
            {
                $_SESSION['gender2'] = $gender2;
            }
        }

        if(isset($_POST['biography']))
        {
            $_SESSION['biography'] = $_POST['biography'];
        }
    }

    $view = new Template();
    echo $view->render('views/interest.html');
});


$f3->route('POST|GET /summary', function ($f3) {
    //Save POST Array properties to the $f3 object
    $f3->set('title', 'Your Profile');
    $f3->set('name', $_SESSION['fname']." ".$_SESSION['lname']);
    $f3->set('gender', $_SESSION['gender']);
    $f3->set('age', $_SESSION['age']);
    $f3->set('phone', $_SESSION['phone']);
    $f3->set('email', $_SESSION['email']);
    $f3->set('state', $_SESSION['state']);
    $f3->set('seeking', $_SESSION['gender2']);
    $f3->set('interests', $_POST['interests']);
    $f3->set('biography', $_SESSION['biography']);

    $view = new Template();
    echo $view->render('views/summary.html');
});

//Rune fat free
$f3->run();
