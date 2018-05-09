<?php

namespace AppBundle\Service;

use AppBundle\Entity\Entry;
use AppBundle\Entity\FeedSource;
use Doctrine\ORM\EntityManager;

/**
 * Class ImportFeed
 */
class ImportFeed
{

    /**
     * @var EntityManager
     */
    protected $em = null;

    /**
     * ImportFeed constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * @param $url
     * @return bool
     */
    public function importFromUrl($url)
    {
        if (preg_match('/^((http[s]?|ftp):\/)?\/?([^:\/\s]+)((\/\w+)*\/)([\w\-\.]+[^#?\s]+)(.*)?(#[\w\-]+)?$/', $url)) {

            $em = $this->em;
            if (!($source = $em->getRepository(FeedSource::class)->findOneBy(['url' => $url]))) {

                $source = new FeedSource();
                $source->setUrl($url);

                $em->persist($source);

            }

            $source->setImportDate(new \DateTime());
            $em->flush($source);

            return $this->import($source);
        }

    }

    /**
     * @param $sourceId
     */
    public function importFromSource($sourceId)
    {
        $em = $this->em;
        if ($source = $em->getRepository(FeedSource::class)->find($sourceId)) {

            $source->setImportDate(new \DateTime());
            $em->flush($source);

            $this->import($source);
        }
    }

    /**
     * @param FeedSource $source
     * @return bool
     */
    protected function import(FeedSource $source)
    {
        if ($content = file_get_contents($source->getUrl())) {

            try {

                $content = (array)(new \SimpleXMLElement($content));


                $list = [];

                if ($content['entry']) {
                    /* @var \SimpleXMLElement $xmlEntry */
                    foreach ($content['entry'] as $xmlEntry) {

                        if ($this->validateEntry($xmlEntry)) {

                            $entry = new Entry();

                            $entry->setEntryId((string)$xmlEntry->id);
                            $entry->setTitle((string)$xmlEntry->title);

                            $entry->setUpdateDate(new \DateTime((string)$xmlEntry->updated));

                            if (!empty($xmlEntry->content)) {
                                $entry->setContent((string)$xmlEntry->content);
                            }

                            if (!empty($xmlEntry->link)) {
                                $entry->setLink((string)$xmlEntry->link['href']);
                            }

                            if (!empty($xmlEntry->summary)) {
                                $entry->setSummary(strip_tags((string)$xmlEntry->summary));
                            }

                            if (!empty($xmlEntry->author)) {
                                $entry->setAuthor((string)$xmlEntry->author->name);
                            }

                            $entry->setFeed($source);
                            $entry->setImportDate(new \DateTime());

                            $list[$entry->getEntryId()] = $entry;
                        }
                    }
                }


                if ($list) {
                    $this->em->getRepository(Entry::class)->insertOrUpdateEntries($list, $source);
                }

                return true;
            } catch (\Exception $e) {
                // seems like XML is not well formed

            }

        }

        return false;
    }

    /**
     * Check, if required elements exists
     * @param \SimpleXMLElement $xmlEntry
     * @return bool
     */
    protected function validateEntry(\SimpleXMLElement $xmlEntry)
    {
        return !empty($xmlEntry->id) && !empty($xmlEntry->title) && !empty($xmlEntry->updated);
    }
}

