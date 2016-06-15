<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog_homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findAll();
        
        return $this->render(
            'blog/index.html.twig',
            ['posts' => $posts]
        );
    }

    /**
     * @Route("/blog/{year}/{month}/{day}/{slug}", name="blog_show", requirements={
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
            ->getRepository('AppBundle:Post')
            ->findOneBySlug($slug);
        $em = $this->getDoctrine()->getManager();

        if (!$post) {
            throw $this->createNotFoundException(
                'No post found for slug '.$slug
            );
        }

        return $this->render(
            'blog/show.html.twig',
            ['post' => $post]
        );

    }
}
