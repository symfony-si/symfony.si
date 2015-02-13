<?php

namespace SymfonySi\CheatsheetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SymfonySiCheatsheetBundle:Default:index.html.twig');
    }
}
