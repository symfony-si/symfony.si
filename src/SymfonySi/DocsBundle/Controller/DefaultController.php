<?php

namespace SymfonySi\DocsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $content = file_get_contents($this->getRequest()->server->get('DOCUMENT_ROOT') . '/doc/current/index.html');

        return $this->render('SymfonySiDocsBundle:Default:index.html.twig', array(
            'content' => $content
        ));
    }

    public function showAction($page)
    {
        $page = $this->getRequest()->server->get('DOCUMENT_ROOT') . '/doc/current/' . $page;

        if(file_exists($page)) {
            $content = file_get_contents($page);
        } else {
            throw $this->createNotFoundException('The documentation page does not exist');
        }
        
        return $this->render('SymfonySiDocsBundle:Default:show.html.twig', array(
            'content' => $content
        ));
    }
}
