<?php
/** name validation  */
function validName($name)
{
    return !empty($name) && ctype_alpha($name);
}
/** age validation */
function validAge($age)
{

    return is_numeric($age) && $age >= 18 && $age <= 118;
}

/** phone validation */
function validPhone($phone)
{
    return !empty($phone) && preg_match("/^\d{10}$/",$phone);
}

/** gender selected validation */
function validGender($gender)
{
    return in_array($gender, getGenders());
}

/** state selection validation */
function validState($state)
{
    return in_array($state, getStates());
}

/** Email validation */
function validEmail($email)
{
    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}

/** outdoor interest validation  */
function validOutdoor($outdoorInterests)
{
    foreach($outdoorInterests as $interest) {
        if(!in_array($interest, getOutdoor())) {
            return false;
        }
    }
    return true;
}

/** indoor interest selection validation */
function validIndoor($indoorInterests)
{
    foreach($indoorInterests as $interest) {
        if(!in_array($interest, getIndoor())) {
            return false;
        }
    }
    return true;
}