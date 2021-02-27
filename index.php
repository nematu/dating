<?php
/** controller for Dating site
 *  Dating 3 assignment implementations
 *  Data validation
 *  @autor : Nematullah Ayaz
 */
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validation.php');

// Instantiate Fat-Free
$f3 = Base::instance();
// Turn on Fat-Free Error Reporting
$f3->set('DEBUG', 3);


// Define Default Route
$f3->route('GET /', function ($f3)
{
    //Display view
    $view = new Template();
    echo $view->render('views/home.html');
});

// Define second route "personal"
$f3->route('GET|POST /personal', function ($f3) {
    $f3->set('genders', getGenders());
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // Add data from to session array
        $f3->set('fname', $_POST['fname']);
        if(validName($_POST['fname']))
        {
            $_SESSION['fname'] = $_POST['fname'];
        }
        else{

            $f3->set("errors['fname']", 'First Name is required !');
        }
        $f3->set('lname', $_POST['lname']);
        if(validName($_POST['lname']))
        {
            $_SESSION['lname'] = $_POST['lname'];
        }
        else{
            $f3->set("errors['lname']", 'Last Name is required');
        }
        $f3->set('age', $_POST['age']);
        if(validAge($_POST['age']))
        {
            $_SESSION['age'] = $_POST['age'];
        }
        else{
            $f3->set("errors['age']", 'Age is required and must be in range 8->18');
        }
        $f3->set('phone', $_POST['phone']);
        if(validPhone($_POST['phone']))
        {
            $_SESSION['phone'] = $_POST['phone'];
        }
        else{
            $f3->set("errors['phone']", 'Enter a valid phone number');
        }
        $f3->set('userGender', $_POST['userGender']);
        if($_POST['userGender'] != null && validGender($_POST['userGender'])) {
            $_SESSION['userGender'] = $_POST['userGender'];
        }
        else {
            $_SESSION['userGender'] = "";
        }
        // if no errors found reroute to profile page
        if(empty($f3->get('errors'))) {
            $f3->reroute('profile');
        }
    }

    $view = new Template();
    echo $view->render('views/personal.html');
});

// PROFILE PAGE
$f3->route('GET|POST /profile', function ($f3) {
    $f3->set('states',getStates());
    $f3->set('genders', getGenders());
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $f3->set('email', $_POST['email']);
        if(validEmail($_POST['email'])) {
            $_SESSION['email'] = $_POST['email'];
        }
        else{
            $f3->set("errors['email']", 'Email is not valid !');
        }

        $f3->set('userState', $_POST['states']);
        if(validState($_POST['states'])) {
            $_SESSION['state'] = $_POST['states'];
        }
        else{
            $_SESSION['states'] = "";
        }
        $f3->set('seeking', $_POST['seeking']);
        if($_POST['seeking'] != null && validGender($_POST['seeking'])) {
            $_SESSION['seeking'] = $_POST['seeking'];
        }
        else{
            $_SESSION['seeking'] = "";
        }

        $f3->set('bio', $_POST['bio']);
        if(!empty($_POST['bio'])) {
            $_SESSION['bio'] = $_POST['bio'];
        }
        else{
            $_SESSION['bio'] = "";
        }

        // if no errors reroute to interest page
        if(empty($f3->get('errors'))) {
            $f3->reroute('interest');
        }
    }

    $view = new Template();
    echo $view->render('views/profile.html');
});

// INTEREST PAGE
$f3->route('GET|POST /interest', function ($f3) {
    $f3->set('indoor', getIndoor());
    $f3->set('outdoor', getOutdoor());

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        if(isset($_POST['indoorInterests']) && validIndoor($_POST['indoorInterests'])){
            $_SESSION['indoorInterests'] = $_POST['indoorInterests'];
        }
        else{

            $_SESSION['indoorInterests'] = (array) null;
        }

        if(isset($_POST['outdoorInterests']) && validOutdoor($_POST['outdoorInterests'])){
            $_SESSION['outdoorInterests'] = $_POST['outdoorInterests'];
        }
        else {

            $_SESSION['outdoorInterests'] = (array) null;
        }

        if(!empty($_SESSION['outdoorInterests'] || $_SESSION['indoorInterests'])) {
            $_SESSION['indoorAndOutdoor'] =
                implode(", ", array_merge($_SESSION['indoorInterests'],$_SESSION['outdoorInterests']));
        }
        else{
            $_SESSION['indoorAndOutdoor'] ="";
        }
        $f3->reroute('summary');
    }
    $view = new Template();
    echo $view->render('views/interest.html');
});

// SUMMARY PAGE
$f3->route('GET|POST /summary', function () {
    //var_dump($_SESSION);
    $view = new Template();
    echo $view->render('views/summary.html');
    //session_destroy();
});

//Rune fat free
$f3->run();