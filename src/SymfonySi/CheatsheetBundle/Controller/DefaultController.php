<?php

namespace SymfonySi\CheatsheetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use League\CommonMark\CommonMarkConverter;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $file = __DIR__.'/../../../../cheatsheet/README.md';
        $content = (file_exists($file)) ? file_get_contents($file) : '<h1>Symfony cheat sheet</h1>';

        $converter = new CommonMarkConverter();
        $html = $converter->convertToHtml($content);

        return $this->render('SymfonySiCheatsheetBundle:Default:index.html.twig', array('html' => $html));
    }
}
