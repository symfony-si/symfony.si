<?php

namespace SymfonySi\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/blog", name="symfony_si_blog_homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()
            ->getRepository('SymfonySiBlogBundle:Post')
            ->findAll();
        
        return $this->render(
            'SymfonySiBlogBundle:Default:index.html.twig',
            ['posts' => $posts]
        );
    }

    /**
     * @Route("/blog/{year}/{month}/{day}/{slug}", name="symfony_si_blog_show", requirements={
     *     "year": "\d+",
     *     "month": "\d+",
     *     "day": "\d+"
     * })
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($slug)
    {
        $post = $this->getDoctrine()
            ->getRepository('SymfonySiBlogBundle:Post')
            ->findOneBySlug($slug);
        $em = $this->getDoctrine()->getManager();

        if (!$post) {
            throw $this->createNotFoundException(
                'No post found for slug '.$slug
            );
        }

        return $this->render(
            'SymfonySiBlogBundle:Default:show.html.twig',
            ['post' => $post]
        );

    }
}
