<?php

namespace SymfonySi\EcosystemBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/ecosystem", name="symfony_si_ecosystem_homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $projects = $this->getDoctrine()
            ->getRepository('SymfonySiEcosystemBundle:Project')
            ->findAll();

        return $this->render(
            'SymfonySiEcosystemBundle:Default:index.html.twig',
            ['projects' => $projects]
        );
    }
}
