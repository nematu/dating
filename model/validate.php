<?php
/**
 * Data Validation Class
 */

class Validate
{
    private $_dataLayer;

    /**
     * Validate constructor.
     */
    public function __construct()
    {
        $this->_dataLayer = new DataLayer();
    }

    /**
     * Checks that the supplied name is a String containing only alphabetic characters
     * @param $name String to validate as a valid name
     * @return boolean true or false if valid
     */
    function validName($name)
    {
        //Verify $name is not empty and is only alphabetical characters
        return !empty($name) && ctype_alpha($name);
    }

    /**
     * Checks that a supplied age is numeric and between 18-118
     * @param $age Number to validate as a valid age
     * @return boolean true or false if valid
     */
    function validAge($age)
    {
        //Verify $age is a number and is between 18 - 118
        return is_numeric($age) && $age >= 18 && $age <= 118;
    }

    /**
     * Checks that a supplied Number is a valid phone number containing 10 numbers
     * @param $phone Number to validate as a valid phone number
     * @return boolean true if valid, false otherwise
     */
    function validPhone($phone)
    {
        //Verify phone number is numeric and has a length of 10
        return is_numeric($phone) && strlen((string)$phone) == 10;
    }

    /**
     * Checks that a supplied gender exists in data-layer.php
     * @param $gender String supplied gender
     * @return bool true if valid, false otherwise
     */
    function validGender($gender)
    {
        //Verify gender matches the available gender options in data-layer.php
        return in_array($gender, $this->_dataLayer->getGenders());
    }

    /**
     * Checks that a supplied state exists in the data-layer.php
     * @param $state String supplied state
     * @return bool true if state is valid, false otherwise
     */
    function validState($state)
    {
        //Verify state matches the available states in data-layer.php
        return in_array($state, $this->_dataLayer->getStates());
    }

    /**
     * Checks that a supplied String is a valid email address
     * @param $email String to validate as a valid email address
     * @return boolean true if email contains proper format, false otherwise
     */
    function validEmail($email)
    {
        //Validate email address format
        $patternEmail = '^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$^';
        return preg_match($patternEmail, $email);
    }

    /**
     * Checks that all elements in the outdoorInterests array exist in data-layer.php
     * @param $outdoorInterests array user selected interests
     * @return bool true if selections are valid, false otherwise
     */
    function validOutdoor($outdoorInterests)
    {
        //For each element in array, check it is in the data-layer.php array
        foreach($outdoorInterests as $interest) {
            if(!in_array($interest, $this->_dataLayer->getOutdoorInterests())) {
                return false;
            }
        }
        return true;
    }

    /**
     * Checks that all elements in the indoorInterests array exist in data-layer.php
     * @param $indoorInterests array user selected interests
     * @return bool true if selections are valid, false otherwise
     */
    function validIndoor($indoorInterests)
    {
        //For each element in array, check it is in the data-layer.php array
        foreach($indoorInterests as $interest) {
            if(!in_array($interest, $this->_dataLayer->getIndoorInterests())) {
                return false;
            }
        }
        return true;
    }
}