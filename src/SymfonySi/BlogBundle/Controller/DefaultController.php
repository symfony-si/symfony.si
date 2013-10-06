<?php

namespace SymfonySi\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SymfonySiBlogBundle:Default:index.html.twig');
    }
}
