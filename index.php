<?php

/**
 * Nematullah Ayaz
 * jan 26, 2021
 * Dating Assignment
 */
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Start a session
session_start();

//connect to database
require $_SERVER['DOCUMENT_ROOT'] . '/../config.php';

//Instantiate my classes
$f3 = Base::instance();
$validator = new Validate();
$dataLayer = new DataLayer($dbh);
$controller = new Controller($f3);

$f3->set('DEBUG', 3);

//Define a default root (home page)
$f3->route('GET /', function () {
    global $controller;
    $controller->home();
});

//Define a personal information route
$f3->route('GET|POST /personal', function() {
    global $controller;
    $controller->personal();
});

//Define a profile route
$f3->route('GET|POST /profile', function() {
    global $controller;
    $controller->profile();
});

//Define an interests route
$f3->route('GET|POST /interests', function() {
    global $controller;
    $controller->interests();
});

//Define a summary route
$f3->route('GET|POST /summary', function() {

    global $controller;
    $controller->summary();
});

//Define a admin route
$f3->route('GET /admin', function() {

    global $controller;
    $controller->admin();
});
//Rune fat free
$f3->run();
