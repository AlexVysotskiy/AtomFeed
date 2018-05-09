<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * List of all entries from sources
 *
 * @ORM\Table("entries")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntryRepository")
 */
class Entry
{

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
     * @var \DateTime
     * @ORM\Column(name="update_date", type="datetime")
     */
    protected $updateDate;

    /**
     * @var \DateTime
     * @ORM\Column(name="import_date", type="datetime")
     */
    protected $importDate;

    /**
     * @ORM\ManyToOne(targetEntity="FeedSource")
     * @ORM\JoinColumn(name="feed_id", referencedColumnName="id")
     */
    protected $feed;

    /**
     * @ORM\OneToOne(targetEntity="RateEntry")
     * @ORM\JoinColumn(name="rate_id", referencedColumnName="entry_id")
     */
    protected $userRate;

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     * @return self
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
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
    public function getFeed()
    {
        return $this->feed;
    }

    /**
     * @param mixed $feed
     * @return self
     */
    public function setFeed($feed)
    {
        $this->feed = $feed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImportDate()
    {
        return $this->importDate;
    }

    /**
     * @param mixed $importDate
     * @return self
     */
    public function setImportDate(\DateTime $importDate)
    {
        $this->importDate = $importDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     * @return self
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     * @return self
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * @param \DateTime $updateDate
     * @return self
     */
    public function setUpdateDate(\DateTime $updateDate)
    {
        $this->updateDate = $updateDate;
        return $this;
    }

    /**
     * @return RateEntry
     */
    public function getUserRate()
    {
        return $this->userRate;
    }

    /**
     * @param mixed $userRate
     * @return self
     */
    public function setUserRate(RateEntry $userRate)
    {
        $this->userRate = $userRate;
        return $this;
    }



}
