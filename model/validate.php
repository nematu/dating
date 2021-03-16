<?php
/**
 * Data Validation Class
 * @author Nematullah Ayaz
 * @Version 1.0
 */

class Validate
{
    private $_dataLayer;

    function __construct()
    {
        $this->_dataLayer = new DataLayer($dbh);
    }

    function validFname($fname)
    {
        return !empty($fname) && ctype_alpha($fname);
    }

    function validLname($lname)
    {
        return !empty($lname) && ctype_alpha($lname);
    }

    function validAge($age)
    {
        if(is_numeric($age) && 18 <= $age && $age <= 118 ){
            return true;
        }
        return false;
    }

    function validPhone($phone)
    {
        if(!empty($phone) && preg_match('/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', $phone) && strlen($phone)==10){
            return true;
        }
        return false;
    }


    function validEmail($email)
    {
        return !empty($email) && preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $email);
    }


    function validOutdoor($selectedOutdoor)
    {
        //Get valid condiments from data layer
        $validOutdoor = $this->_dataLayer->getOutdoor();

        //Check every selected condiment
        foreach ($selectedOutdoor as $selected) {

            //If the selected condiment is not in the valid list, return false
            if (!in_array($selected, $validOutdoor)) {
                return false;
            }
        }

        //If we haven't false by now, we're good!
        return true;
    }


    function validIndoor($selectedIndoor)
    {
        //Get valid condiments from data layer
        $validIndoor = $this->_dataLayer->getIndoor();

        //Check every selected condiment
        foreach ($selectedIndoor as $selected) {

            //If the selected condiment is not in the valid list, return false
            if (!in_array($selected, $validIndoor)) {
                return false;
            }
        }

        //If we haven't false by now, we're good!
        return true;
    }
}