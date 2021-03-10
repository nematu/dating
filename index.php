<?php
/**
 * Nematullah Ayaz
 * Dating Assignment
 * Jan 26/2021
 */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Session start after require_once
session_start();

//Create an instance of the Base Class
$f3 = Base::instance();
$validator = new Validate();
$dataLayer = new DataLayer();
$controller = new Controller($f3);

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

//Define a default root (home page)
$f3->route('GET /', function ($f3)
{
    global $controller;
    $controller->home();
});

//personal Route
$f3->route('GET|POST /personal', function ($f3)
{
    global $controller;
    $controller->personal();
});

//profile Route
$f3->route('GET|POST /profile', function ($f3)
{
    global $controller;
    $controller->profile();
});

//interest Route
$f3->route('GET|POST /interest', function ($f3)
{
   global $controller;
   $controller->interest();
});

//Summary Route
$f3->route('GET|POST /summary', function ($f3)
{
    global $controller;
    $controller->summary();
});

//Rune fat free
$f3->run();