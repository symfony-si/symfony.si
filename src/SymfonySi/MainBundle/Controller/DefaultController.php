<?php

namespace SymfonySi\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SymfonySiMainBundle:Default:index.html.twig');
    }
}
