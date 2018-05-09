<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Entry;
use AppBundle\Entity\FeedSource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repo = $this->getDoctrine()->getEntityManager()->getRepository(Entry::class);

        if ($request->get('rate')) {

            if ($entryId = $request->get('entry')) {
                $repo->rateEntry($entryId, $request->get('score'));
            }
        }

        $page = abs(intval($request->get('page')));
        $limit = 90;


        // replace this example code with whatever you need
        return $this->render('feed_list.html.twig', array(
            'list' => $repo->getFeeds($page, $limit)
        ));
    }

    /**
     * @Route("/sources", name="sources_list")
     */
    public function sourcesListAction(Request $request)
    {
        if ($request->get('import')) {

            $importer = $this->get('feed_importer');
            if ($url = $request->get('url')) {
                $importer->importFromUrl($url);
            } elseif ($source = $request->get('source')) {
                $importer->importFromSource($source);
            }

            return $this->redirectToRoute('sources_list', []);
        }

        $repo = $this->getDoctrine()->getEntityManager()->getRepository(FeedSource::class);

        // replace this example code with whatever you need
        return $this->render('feed_source_list.html.twig', array(
            'list' => $repo->findAll()
        ));
    }
}
