<?php

namespace SymfonySi\DocsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SymfonySiDocsBundle:Default:index.html.twig');
    }
}
