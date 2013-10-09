<?php

namespace SymfonySi\DocsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $book = round(0/21 * 100);
        $bundles = round(2/2 * 100);
        $components = round(0/83 * 100);
        $contributing = round(0/21 * 100);
        $cookbook = round(0/130 * 100);
        $quickTour = round(0/5 * 100);
        $reference = round(0/140 * 100) ;
        $others = round(5/5 * 100);
        $sum = round(5/407 * 100);
        return $this->render('SymfonySiDocsBundle:Default:index.html.twig', array(
            'book' => $book . ' %',
            'bundles' => $bundles . ' %',
            'components' => $components . ' %',
            'contributing' => $contributing . ' %',
            'cookbook' => $cookbook . ' %',
            'quicktour' => $quickTour . ' %',
            'reference' => $reference . ' %',
            'others' => $others . ' %',
            'sum' => $sum . ' %'
        ));
    }
}
