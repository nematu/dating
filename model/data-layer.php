<?php

/**
 * Data Layer Class
 * @author Nematullah Ayaz
 * @Version 1.0
 */

class DataLayer
{

    private $_dbh;

    /**
     * DataLayer constructor
     * @param $dbh
     */
    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    /**
     * inserts member to database
     * @param $member
     */
    function insertMember($member)
    {
        //define the query
        $sql = "INSERT INTO member(fname, lname, age, gender, phone, email, state, seeking, bio, premium, interests)
        VALUES(:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :interests)";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(":fname", $member->getFname(), PDO::PARAM_STR);
        $statement->bindParam(":lname", $member->getLname(), PDO::PARAM_STR);
        $statement->bindParam(":age", $member->getAge(), PDO::PARAM_INT);
        $statement->bindParam(":gender", $member->getGender(), PDO::PARAM_STR);
        $statement->bindParam(":phone", $member->getPhone(), PDO::PARAM_STR);
        $statement->bindParam(":email", $member->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(":state", $member->getState(), PDO::PARAM_STR);
        $statement->bindParam(":seeking", $member->getSeeking(), PDO::PARAM_STR);
        $statement->bindParam(":bio", $member->getBio(), PDO::PARAM_STR);
        //if a member is a premium member then store it as a 1 in the database
        $premium = $member instanceof PremiumMember ? 1 : 0;
        $statement->bindParam(":premium", $premium, PDO::PARAM_INT);
        //if a member is a premium member then set interests as a list. If not save it as an empty string
        $interests = $premium ? $member->getInDoorInterests() . $member->getOutDoorInterests() : "";
        $statement->bindParam(":interests", $interests, PDO::PARAM_STR);

        //execute
        $statement->execute();
    }

    /**
     * store members by last Name
     * @return mixed
     */
    function getMembers()
    {
        //define the query
        $sql = "SELECT * FROM member ORDER BY lname";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //execute
        $statement->execute();

        //get the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * retrieved members information
     * @param $member_id
     * @return mixed
     */
    function getMember($member_id)
    {
        //define the query
        $sql = "SELECT * FROM member WHERE member_id = :member_id";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //bind the parameters
        $statement->bindParam(":member", $member_id, PDO::PARAM_STR);

        //execute
        $statement->execute();

        //return the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }


    function getInterests($member_id)
    {
        //define the query
        $sql = "SELECT interests FROM member WHERE member_id = :member_id";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //bind the parameters
        $statement->bindParam(":member", $member_id, PDO::PARAM_STR);

        //execute
        $statement->execute();

        //return the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }


    function getOutdoor()
    {
        return array("hiking", "biking", "swimming", "collecting", "walking", "climbing");
    }


    function getIndoor()
    {
        return array("tv", "movies", "cooking", "board games", "puzzle", "reading", "playing cards", "video games");
    }

    function getGender()
    {
        return array("male", "female");
    }
}