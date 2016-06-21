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
        $posts = $this->get('app.repository.post')->findAll();
        
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
        $post = $this->get('app.repository.post')->findOneBy([
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'num' => $num,
            'slug' => $slug
        ]);

        $sidebarPosts = $this->get('app.repository.post')->findLatest();

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
