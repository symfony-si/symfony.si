<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;


/**
 * Slovenian translation of PHP Standards Recommendations.
 *
 * @Route("/psr")
 */
class PsrController extends Controller
{
    /**
     * @Route("", name="psr_index")
     * @Cache(maxage="20", public=true)
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('psr/index.html.twig', [
            'psrs' => $this->get('app.repository.psr')->findAll()
        ]);
    }

    /**
     * @Route("/{slug}", name="psr_show")
     * @Cache(maxage="20", public=true)
     *
     * @param string $slug
     * @return Response
     */
    public function showAction($slug)
    {
        $psr = $this->get('app.repository.psr')->findOneBySlug($slug);

        if (!$psr) {
            throw $this->createNotFoundException(
                'No PSR found for slug '.$slug
            );
        }

        return $this->render('psr/show.html.twig', [
            'psr' => $psr,
            'psrs' => $this->get('app.repository.psr')->findAll()
        ]);
    }
}
