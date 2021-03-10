<?php
/** Memebr Class
 * @author Nematullah Ayaz
 * Dating Assignment
 */

class Member {

    /**
     * fields
     * @var String fields
     */

    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor.
     * @param $_fname String first name
     * @param $_lname String second name
     * @param $_age Number age
     * @param $_gender String gender
     * @param $_phone Number phone number
     */
    public function __construct($_fname, $_lname, $_age, $_gender, $_phone)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_gender = $_gender;
        $this->_phone = $_phone;
    }

    /**
     * Returns the member's first name
     * @return String first name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Sets the member's first name
     * @param String $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * Returns the member's last name
     * @return String last name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Sets the member's last name
     * @param String $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * Returns the member's age
     * @return Number age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * Sets the member's age
     * @param Number $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * Returns the member's gender
     * @return String gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * Sets the member's gender
     * @param String $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * Returns the member's phone number
     * @return Number phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Sets the member's phone number
     * @param Number $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Returns the member's email address
     * @return mixed email address
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Sets the member's email address
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Returns the member's state
     * @return mixed state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Sets the member's state
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * Returns the member's seeking gender
     * @return mixed seeking gender
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * Sets the member's seeking gender
     * @param mixed $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * Returns the member's bio
     * @return mixed bio
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * Sets the member's bio
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}