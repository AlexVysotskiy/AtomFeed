<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Entry;
use AppBundle\Entity\FeedSource;
use AppBundle\Entity\RateEntry;
use Doctrine\ORM\EntityRepository;

/**
 * Class EntryRepository
 */
class EntryRepository extends EntityRepository
{
    /**
     * @param Entry[] $list
     */
    public function insertOrUpdateEntries($list, FeedSource $source)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        /*$conditions = $qb->expr()->andX();
        $conditions->add($qb->expr()->in('e.entryId', array_keys($list)));
        $conditions->add($qb->expr()->eq('e.entryId', $source->getId()));*/

        $existedEntries = $qb->select(array('e'))
            ->from(Entry::class, 'e')
            ->where($qb->expr()->in('e.entryId', array_keys($list)))
            ->getQuery()->getResult();


        /* @var Entry $entry */
        foreach ($existedEntries as $entry) {

            if (isset($list[$entry->getEntryId()])) {

                if ($entry->getUpdateDate()->getTimestamp() != $list[$entry->getEntryId()]->getUpdateDate()->getTimestamp()) {

                    $newEntry = $list[$entry->getEntryId()];
                    $entry->setUpdateDate($newEntry->getUpdateDate());
                    $entry->setSummary($newEntry->getSummary());
                    $entry->setContent($newEntry->getContent());
                    $entry->setLink($newEntry->getLink());
                }

                unset($list[$entry->getEntryId()]);
            }
        }

        foreach ($list as $entry) {
            $em->persist($entry);
        }

        $em->flush();
    }

    /**
     * @param int $limit
     * @param int $page
     * @return array
     */
    public function getFeeds($limit = 30, $page = 0)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $q = $qb->select(array('e'))
            ->from(Entry::class, 'e')
            ->setFirstResult($limit * $page)
            ->setMaxResults($limit)
            ->addOrderBy('e.updateDate', 'DESC')
            ->getQuery();

        return $q->getResult();
    }

    /**
     * @param $entryId
     * @param $score
     */
    public function rateEntry($entryId, $score)
    {
        /* @var Entry $entry */
        if ($entry = $this->find($entryId)) {

            $em = $this->getEntityManager();

            $score = intval($score);

            if ($entry->getUserRate()) {

                $entry->getUserRate()->setRate($score);

            } else {


                $rate = new RateEntry();
                $rate->setUserId(1);
                $rate->setEntryId($entryId);
                $rate->setRate($score);

                $em->persist($rate);

                $entry->setUserRate($rate);
            }

            $em->flush();
        }
    }
}
