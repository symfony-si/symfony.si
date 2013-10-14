<?php

namespace SymfonySi\DocsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $book = round(2/21 * 100);
        $bundles = round(2/2 * 100);
        $components = round(2/83 * 100);
        $contributing = round(10/21 * 100);
        $cookbook = round(2/131 * 100);
        $quickTour = round(5/5 * 100);
        $reference = round(3/140 * 100) ;
        $others = round(5/5 * 100);
        $sum = round(55/408 * 100);
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
