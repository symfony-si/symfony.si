<?php

namespace SymfonySi\CheatsheetBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use League\CommonMark\CommonMarkConverter;

class DefaultController extends Controller
{
    /**
     * @Route("/cheatsheet", name="symfony_si_cheatsheet_homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $file = __DIR__.'/../../../../cheatsheet/README.md';
        $content = (file_exists($file)) ? file_get_contents($file) : '<h1>Symfony cheat sheet</h1>';

        $converter = new CommonMarkConverter();
        $html = $converter->convertToHtml($content);

        return $this->render('SymfonySiCheatsheetBundle:Default:index.html.twig', ['html' => $html]);
    }
}
