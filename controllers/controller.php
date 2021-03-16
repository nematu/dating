<?php
/**
 * Controller Class
 * @author Nematullah Ayaz
 * @version 1.0
 */

class Controller
{
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * routing to home page
     */
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * routing to personal page
     */
    function personal()
    {
        //add global variables
        global $validator;
        global $dataLayer;
        global $member;

        //get array
        $this->_f3->set('genders', $dataLayer->getGender());


        //if the form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //get the data from the POST array
            $userFname = $_POST['fname'];
            $userLname = $_POST['lname'];
            $userGender = $_POST['gender'];
            $userAge = $_POST['age'];
            $userPhone = $_POST['pnumber'];
            $isPremium = $_POST['isPremium'];


            if(isset($isPremium)){
                $member = new PremiumMember($userFname, $userLname, $userAge, $userGender, $userPhone);
            } else {
                $member = new Member($userFname, $userLname, $userAge, $userGender, $userPhone);
            }


            if($validator->validFname($userFname)){
                $member->setFname($userFname);
            }
            else {
                $this->_f3->set('errors["fname"]', "First Name is required !");
            }

            if($validator->validLname($userLname)){
                //$_SESSION['lname'] = $userLname;
                $member->setLname($userLname);
            }
            else {
                $this->_f3->set('errors["lname"]', "Last Name is required !");
            }

            //validate gender
            if(isset($userGender)){
                $member->setGender($userGender);
            }

            //validate age
            if($validator->validAge($userAge)){
                //$_SESSION['age'] = $userAge;
                $member->setAge($userAge);
            }
            else {
                $this->_f3->set('errors["age"]', "Enter Age and should be between 18 and 118");
            }


            if($validator->validPhone($userPhone)){
                $member->setPhone($userPhone);
            }
            else {
                $this->_f3->set('errors["pnumber"]', "Phone number must be 10 digits long");
            }

            if(empty($this->_f3->get('errors'))){
                $_SESSION['member'] = $member;
                $this->_f3->reroute('/profile');
            }
        }

        //make form sticky
        $this->_f3->set('userFname', isset($userFname) ? $userFname : "");
        $this->_f3->set('userLname', isset($userLname) ? $userLname : "");
        $this->_f3->set('userAge', isset($userAge) ? $userAge : "");
        $this->_f3->set('userGender', isset($userGender) ? $userGender : "");
        $this->_f3->set('userPhone', isset($userPhone) ? $userPhone : "");

        $view = new Template();
        echo $view->render('views/personal.html');
    }

    /**
     * Display profle page
     */
    function profile()
    {
        //add global variables
        global $validator;
        global $dataLayer;

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //get the data from the POST array
            $userEmail = $_POST['email'];
            $userState = $_POST['state'];
            $userSeeking = $_POST['seeking'];
            $userBio = $_POST['bio'];

            //validate email
            if($validator->validEmail($userEmail)){
//                $_SESSION['email'] = $userEmail;
                $_SESSION['member']->setEmail($userEmail);
            }
            else {
                $this->_f3->set('errors["email"]', "Enter a Valid Email !");
            }

            //validate state
            if(isset($userState)){
                $_SESSION['member']->setState($userState);
            }


            //validate seeking
            if(isset($userSeeking)){
               $_SESSION['seeking'] = $userSeeking;
                $_SESSION['member']->setSeeking($userSeeking);
            }

            //validate bio
            if(isset($userBio)){

                $_SESSION['member']->setBio($userBio);
            }


            if(empty($this->_f3->get('errors'))){
                if ($_SESSION['member'] instanceof PremiumMember) {
                    //                $_SESSION['member'] = $member;
                    $this->_f3->reroute('/interests');
                } else {
                    $this->_f3->reroute('/summary');
                }
            }
        }

        //get array
        $this->_f3->set('genders', $dataLayer->getGender());

        //make form sticky
        $this->_f3->set('userBio', isset($userBio) ? $userBio : "");
        $this->_f3->set('userSeeking', isset($userSeeking) ? $userSeeking : "");
        $this->_f3->set('userState', isset($userState) ? $userState : "");
        $this->_f3->set('userBio', isset($userBio) ? $userBio : "");

        $view = new Template();
        echo $view->render('views/profile.html');
    }

    /**
     * Display interests page
     */
    function interests()
    {
        //add global variables
        global $validator;
        global $dataLayer;

        //If the form has been submitted
        if ($_SERVER['REQUEST_METHOD']=='POST') {

            //get interests from post array
            $userIndoor = $_POST['indoorInterests'];
            $userOutdoor = $_POST['outdoorInterests'];


            //validate indoor activities
            if(isset($userIndoor)) {
                //Data is valid -> Add to session
                if ($validator->validIndoor($userIndoor)) {
                    $indoorList = implode(", ", $_POST['indoorInterests']);
                    $_SESSION['member']->setInDoorInterests($indoorList);
                } //Data is not valid -> We've been spoofed!
                else {
                    $this->_f3->set('errors["indoor"]', "wrong action!");
                }
            }

            //validate outdoor activities
            if(isset($userOutdoor)) {
                //Data is valid -> Add to session
                if ($validator->validOutdoor($userOutdoor)) {
                  $_SESSION['outdoorInterests'] = implode(", ", $_POST['outdoorInterests']);
                    $outdoorList = implode(", ", $_POST['outdoorInterests']);
                    $_SESSION['member']->setOutDoorInterests($outdoorList);
                }
                else {
                    $this->_f3->set('errors["outdoor"]', "wrong action!");
                }
            }

            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('/summary');
            }
        }

        //get arrays
        $this->_f3->set('indoor', $dataLayer->getIndoor());
        $this->_f3->set('outdoor', $dataLayer->getOutdoor());

        $view = new Template();
        echo $view->render('views/interests.html');
    }

    /**
     * Display summary page
     */
    function summary()
    {
        global $dataLayer;
        $dataLayer->insertMember($_SESSION['member']);

        $view = new Template();
        echo $view->render('views/summary.html');

        //clear session
        session_destroy();
    }

    /**
     * Display admin page
     */
    function admin()
    {
        global $dataLayer;

        $members_table = $dataLayer->getMembers();
        $this->_f3->set('members', $members_table);

        $view = new Template();
        echo $view->render('views/admin.html');
    }

}