<?php

namespace SymfonySi\EcosystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $projects = $this->getDoctrine()
            ->getRepository('SymfonySiEcosystemBundle:Project')
            ->findAll();

        return $this->render(
            'SymfonySiEcosystemBundle:Default:index.html.twig',
            array('projects' => $projects)
        );
    }
}
