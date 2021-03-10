<?php
/**
 * Dating Assignment
 * Class PremiumMember extends from Member Class
 */

class PremiumMember extends Member {

    private $_inDoorInterests;
    private $_outDoorInterests;

    /**
     * Returns the premium member's in-door interests
     * @return mixed in-door interests
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * Sets the premium member's in-door interests
     * @param mixed $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * Returns the premium member's out-door interests
     * @return mixed out-door interests
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * Sets the premium member's in-door interests
     * @param mixed $outDoorInterests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }
}