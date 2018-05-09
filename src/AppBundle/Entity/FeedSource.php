<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * List of all feed source
 * 
 * @ORM\Table("feed_sources")
 * @ORM\Entity
 */
class FeedSource {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $url;

    /**
     * @var \DateTime
     * @ORM\Column(name="import_date", type="datetime")
     */
    protected $importDate;

    public function getId() {
        return $this->id;
    }

    public function getUrl() {
        return $this->url;
    }

    /**
     * @param string $url
     * @return \AppBundle\Entity\Feed
     */
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getImportDate()
    {
        return $this->importDate;
    }

    /**
     * @param \DateTime $importDate
     * @return self
     */
    public function setImportDate($importDate)
    {
        $this->importDate = $importDate;
        return $this;
    }


}
