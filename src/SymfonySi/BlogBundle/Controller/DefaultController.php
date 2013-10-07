<?php

namespace SymfonySi\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $posts = $this->getDoctrine()
            ->getRepository('SymfonySiBlogBundle:Post')
            ->findAll();
         
        return $this->render(
            'SymfonySiBlogBundle:Default:index.html.twig',
            array('posts' => $posts)
        );
    }

    public function showAction($slug)
    {
        $post = $this->getDoctrine()
            ->getRepository('SymfonySiBlogBundle:Post')
            ->findOneBySlug($slug);
        $post->setTranslatableLocale($this->getRequest()->getLocale());

        if (!$post) {
            throw $this->createNotFoundException(
                'No post found for slug '.$slug
            );
        }

        return $this->render(
            'SymfonySiBlogBundle:Default:show.html.twig',
            array('post' => $post)
        );

    }
}
