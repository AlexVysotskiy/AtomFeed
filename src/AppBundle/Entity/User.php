<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * List of all users, who has an access to feed.
 * For some features user need to be logged in.
 * 
 * @ORM\Table("users")
 * @ORM\Entity
 */
class User {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * Encrypted password. Must be persisted.
     *
     * @var string
     */
    protected $password;

}
