<?php

namespace SymfonySi\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SymfonySiMainBundle:Default:index.html.twig');
    }

    public function copyrightAction()
    {
        return $this->render('SymfonySiMainBundle:Default:copyright.html.twig');
    }

    public function joinAction()
    {
        return $this->render('SymfonySiMainBundle:Default:join.html.twig');
    }

    public function clubAction()
    {
        return $this->render('SymfonySiMainBundle:Default:club.html.twig');
    }
}
