<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Symfony SI blog.
 *
 * @Route("/blog")
 */
class BlogController extends Controller
{
    /**
     * @Route("", name="blog_homepage")
     * @return Response
     */
    public function indexAction()
    {
        $posts = $this->get('AppBundle\Repository\PostRepository')->findAll();

        return $this->render(
            'blog/index.html.twig',
            ['posts' => $posts]
        );
    }

    /**
     * @Route("/{year}/{month}/{day}/{num}/{slug}", name="blog_show", requirements={
     *     "year": "\d+",
     *     "month": "\d+",
     *     "day": "\d+",
     *     "num": "\d+"
     * })
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $num
     * @param string $slug
     * @return Response
     */
    public function showAction($year, $month, $day, $num, $slug)
    {
        $post = $this->get('AppBundle\Repository\PostRepository')->findOneBy([
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'num' => $num,
            'slug' => $slug
        ]);

        $sidebarPosts = $this->get('AppBundle\Repository\PostRepository')->findLatest();

        if (!$post) {
            throw $this->createNotFoundException(
                'No post found for slug '.$slug
            );
        }

        return $this->render(
            'blog/show.html.twig',
            ['post' => $post, 'sidebar_posts' => $sidebarPosts]
        );
    }
}
