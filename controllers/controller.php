<?php
/**
 * Controller Class
 * Nematullah Ayaz
 */

class Controller
{
    private $_f3;

    /**
     * Controller constructor.
     * @param $f3 Object fat-free hive
     */
    public function __construct($f3)
    {
        global $dataLayer;
        $this->_f3 = $f3;
        //Set states, genders, and interest arrays to $f3
        $this->_f3->set('states', $dataLayer->getStates());
        $this->_f3->set('genders', $dataLayer->getGenders());
        $this->_f3->set('iInterestList', $dataLayer->getIndoorInterests());
        $this->_f3->set('oInterestList', $dataLayer->getOutdoorInterests());

    }

    /**
     * Displays the home page
     */
    function home()
    {
        //Set global variables and page title
        $this->_f3->set('title', 'Adventure Date!');

        //Render the page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Displays page 1 of profile creation
     */
    function personal()
    {
        //Set global variables and page title
        global $validator;
        $this->_f3->set('title', 'Profile Creation');

        //Save POST content to $f3 for sticky forms
        $this->_f3->set('fName', isset($_POST['fName']) ? $_POST['fName'] : "");
        $this->_f3->set('lName', isset($_POST['lName']) ? $_POST['lName'] : "");
        $this->_f3->set('age', isset($_POST['age']) ? $_POST['age'] : "");
        $this->_f3->set('userGender', isset($_POST['userGender']) ? $_POST['userGender'] : "");
        $this->_f3->set('phone', isset($_POST['phone']) ? $_POST['phone'] : "");
        $this->_f3->set('premium', isset($_POST['pAccount']) ? "checked": "");

        //If POST array is set
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $age = $_POST['age'];

            //Validate fNAme, if valid save to SESSION, else set error
            if($validator->validName($_POST['fName'])){
                $_SESSION['fName'] = $_POST['fName'];
            }
            else{
                $this->_f3->set("errors['fName']", 'Please enter a valid first name');
            }

            //Validate lNAme, if valid save to SESSION, else set error
            if($validator->validName($_POST['lName'])){
                $_SESSION['lName'] = $_POST['lName'];
            }
            else{
                $this->_f3->set("errors['lName']", 'Please enter a valid last name');
            }

            //Validate age, if valid save to SESSION, else set error
            if($validator->validAge($_POST['age'])){
                $_SESSION['age'] = $_POST['age'];
            }
            else{
                $this->_f3->set("errors['age']", 'Please enter a valid age (between 18 - 118)');
            }

            //Validate phone, if valid save to SESSION, else set error
            if($validator->validPhone($_POST['phone'])){
                $_SESSION['phone'] = $_POST['phone'];
            }
            else{
                $this->_f3->set("errors['phone']", 'Please enter a 10-digit phone number');
            }

            //Validate userGender, if valid save to SESSION, else set 'Not Specified'
            if($validator->validGender($_POST['userGender'])){
                $_SESSION['userGender'] = $_POST['userGender'];
            }
            else{
                $_SESSION['userGender'] = "Not Specified";
            }

            //If premium account option was selected, save to SESSION
            $_SESSION['pAccount'] = isset($_POST['pAccount']);


            //If all fields are valid, route to profile
            if(empty($this->_f3->get('errors'))){

                //Save data to new PremiumMember object if premium checkbox selected
                if($_SESSION['pAccount']){
                    $member = new PremiumMember(
                        $_SESSION['fName'],
                        $_SESSION['lName'],
                        $_SESSION['age'],
                        $_SESSION['userGender'],
                        $_SESSION['phone']
                    );
                }
                //Otherwise Save data to new Member object
                else{
                    $member = new Member(
                        $_SESSION['fName'],
                        $_SESSION['lName'],
                        $_SESSION['age'],
                        $_SESSION['userGender'],
                        $_SESSION['phone']
                    );
                }

                //Save member object to $_SESSION
                $_SESSION['member'] = $member;

                $this->_f3->reroute('profile');
            }
        }

        //Render the page
        $view = new Template();
        echo $view->render('views/personal.html');
    }

    /**
     * Displays page 2 of profile creation
     */
    function profile()
    {
        //Set global variables and page title
        global $validator;
        $this->_f3->set('title', 'Profile Creation');

        //Save POST content to $f3 for sticky forms
        $this->_f3->set('email', isset($_POST['email']) ? $_POST['email'] : "");
        $this->_f3->set('userState', $_POST['states']);
        $this->_f3->set('seekingGender', isset($_POST['seekingGender']) ? $_POST['seekingGender'] : "");
        $this->_f3->set('bio', isset($_POST['bio']) ? $_POST['bio'] : "");

        //If POST array is set
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //Validate email, if valid save to SESSION, else set error
            if($validator->validEmail($_POST['email'])){
                $_SESSION['email'] = $_POST['email'];
            }
            else{
                $this->_f3->set("errors['email']", 'Valid email required');
            }

            //Validate states, if valid save to SESSION, else set 'Not Specified'
            if($validator->validState($_POST['states'])){
                $_SESSION['states'] = $_POST['states'];
            }
            else{
                $_SESSION['states'] = "Not Specified";
            }

            //Validate seekingGender, if valid save to SESSION, else set 'Not Specified'
            if($validator->validGender($_POST['seekingGender'])){
                $_SESSION['seekingGender'] = $_POST['seekingGender'];
            }
            else{
                $_SESSION['seekingGender'] = "Not Specified";
            }

            //Validate bio, if not empty save to SESSION, else set 'Not Specified'
            if(!empty($_POST['bio'])){
                $_SESSION['bio'] = $_POST['bio'];
            }
            else{
                $_SESSION['bio'] = "Not Specified";
            }

            //If no errors are set, route to interest
            if(empty($this->_f3->get('errors'))){

                //Save SESSION data to the member object
                $_SESSION['member']->setEmail($_SESSION['email']);
                $_SESSION['member']->setState($_SESSION['states']);
                $_SESSION['member']->setSeeking($_SESSION['seekingGender']);
                $_SESSION['member']->setBio($_SESSION['bio']);

                $this->_f3->reroute('interest');
            }
        }

        //Render the page
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    /**
     * Displays page 3 of profile creation
     */
    function interest()
    {
        //If member is not a premium account, redirect them to the summary page
        if(!$_SESSION['pAccount']){
            $this->_f3->reroute('summary');
        }

        //Set global variables and page title
        global $validator;
        $this->_f3->set('title', 'Profile Creation');

        //If POST array is set
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //Validate iInterests, if valid save to SESSION, else set to empty
            if(isset($_POST['iInterests']) && $validator->validIndoor($_POST['iInterests'])){
                $_SESSION['iInterests'] = $_POST['iInterests'];
            }
            else{
                //Set as array so it can be merged
                $_SESSION['iInterests'] = array();
            }

            //Validate oInterests, if valid save to SESSION, else set to empty
            if(isset($_POST['oInterests']) && $validator->validOutdoor($_POST['oInterests'])){
                $_SESSION['oInterests'] = $_POST['oInterests'];
            }
            else{
                //Set as array so it can be merged
                $_SESSION['oInterests'] = array();
            }

            $_SESSION['member']->setInDoorInterests($_SESSION['iInterests']);
            $_SESSION['member']->setOutDoorInterests($_SESSION['oInterests']);

            //Reroute to summary
            $this->_f3->reroute('summary');
        }

        //Render the page
        $view = new Template();
        echo $view->render('views/interest.html');
    }

    /**
     * Displays the profile summary page
     */
    function summary()
    {
        //Set global variables and page title
        $this->_f3->set('title', 'Your Profile');

        //Render the page
        $view = new Template();
        echo $view->render('views/summary.html');
    }
}