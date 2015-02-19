<?php

namespace SymfonySi\DocsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $file = $this->get('kernel')->getRootDir().'/../web/doc/current/index.html';

        if(file_exists($file) && substr($file, -5) == '.html') {
            $content = file_get_contents($file);
        } else {
            $content = "";
        }

        return $this->render('SymfonySiDocsBundle:Default:index.html.twig', array('content' => $content));
    }

    public function showAction($page)
    {
        $file = $this->get('kernel')->getRootDir().'/../web/doc/current/'.$page;
        //$file = $this->getRequest()->server->get('DOCUMENT_ROOT') . '/doc/current/' . $page;

        if(file_exists($file) && substr($file, -5) == '.html') {
            $content = file_get_contents($file);
        } elseif(file_exists($file) && substr($file, -4) == '.png') {
            return $this->redirect('/doc/current/' . $page);
        } else  {
            throw $this->createNotFoundException('The documentation page does not exist');
        }
        
        return $this->render('SymfonySiDocsBundle:Default:show.html.twig', array(
            'content' => $content
        ));
    }
}
