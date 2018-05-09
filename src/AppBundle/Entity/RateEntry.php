<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * List of all user rates
 *
 * @ORM\Table("rates_entry")
 * @ORM\Entity
 */
class RateEntry
{

    /**
     * @ORM\Id
     * @ORM\Column(name="entry_id", type="integer")
     */
    protected $entryId;

    /**
     * @ORM\Column(name="user_id", type="integer")
     */
    protected $userId;

    /**
     * @ORM\Column(name="rate", type="integer")
     */
    protected $rate;

    public function __construct()
    {
        $this->rate = 0;
    }

    /**
     * @return mixed
     */
    public function getEntryId()
    {
        return $this->entryId;
    }

    /**
     * @param mixed $entryId
     * @return self
     */
    public function setEntryId($entryId)
    {
        $this->entryId = $entryId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param mixed $rate
     * @return self
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return self
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

}
