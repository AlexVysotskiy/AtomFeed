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

}
