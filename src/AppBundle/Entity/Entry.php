<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * List of all entries from sources
 * 
 * @ORM\Table("entries")
 * @ORM\Entity
 */
class Entry {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="entry_id", type="string", nullable=false)
     */
    protected $entryId;

    /**
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    protected $title;

    /**
     * @ORM\Column(name="author", type="string", nullable=true)
     */
    protected $author;

    /**
     * @ORM\Column(name="content", type="string", nullable=true)
     */
    protected $content;

    /**
     * @ORM\Column(name="link", type="string", nullable=true)
     */
    protected $link;

    /**
     * @ORM\Column(name="summary", type="string", nullable=true)
     */
    protected $summary;

    /**
     * @ORM\Column(name="update_date", type="datetime")
     */
    protected $updateDate;

    /**
     * @ORM\Column(name="import_date", type="datetime")
     */
    protected $importDate;

    /**
     * @ORM\ManyToOne(targetEntity="FeedSource")
     * @ORM\JoinColumn(name="feed_id", referencedColumnName="id")
     */
    protected $feed;

}
