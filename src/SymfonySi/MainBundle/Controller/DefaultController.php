<?php

namespace SymfonySi\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SymfonySi\MainBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('SymfonySiBlogBundle:Post');

        $q = $repository->createQueryBuilder('p')
            ->orderBy('p.created', 'DESC')
            ->setMaxResults(10)
            ->getQuery();

        $posts = $q->getResult();

        $jsonData = json_decode(file_get_contents('http://knpbundles.com/newest.json'), true);

        return $this->render('SymfonySiMainBundle:Default:index.html.twig', array(
            'posts' => $posts,
            'bundles' => $jsonData['results']
        ));
    }

    public function copyrightAction()
    {
        return $this->render('SymfonySiMainBundle:Default:copyright.html.twig');
    }

    public function joinAction()
    {
        return $this->render('SymfonySiMainBundle:Default:join.html.twig');
    }

    public function contactAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->createFormBuilder($contact)
            ->add('name', 'text')
            ->add('email', 'email')
            ->add('message', 'textarea')
            ->add('send', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid()) {
            // send email to admin

            $message = \Swift_Message::newInstance()
                ->setSubject('Message from Symfony.si')
                ->setFrom($contact->getEmail())
                ->setTo($this->container->getParameter('symfonysi_admin_email'))
                ->setBody(
                    $this->renderView(
                        'SymfonySiMainBundle:Default:email.txt.twig',
                        array(
                            'name' => $contact->getName(),
                            'email' => $contact->getEmail(),
                            'message' => $contact->getMessage()
                        )
                    )
                )
            ;
            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('symfony_si_main_contact_success'));
        }

        return $this->render('SymfonySiMainBundle:Default:contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function contactSuccessAction()
    {
        return $this->render('SymfonySiMainBundle:Default:contactSuccess.html.twig');
    }

    public function contributorsAction()
    {
        $cache = $this->get('kernel')->getRootDir().'/../var/cache/github-api-cache';
        $client = new \Github\Client(
            new \Github\HttpClient\CachedHttpClient(array('cache_dir' => $cache))
        );
        $srcContributors = $client->api('repo')->contributors('symfony-si', 'symfony.si');
        $docsContributors = $client->api('repo')->contributors('symfony-si', 'symfony-docs-sl');
        $contributors = array();

        foreach($srcContributors as $key=>$contributor) {
            $user = $client->api('user')->show($contributor['login']);
            $contributors[$contributor['login']] = array(
                'name'       => ($user['name']) ? $user['name'] : $contributor['login'],
                'html_url'   => $user['html_url'],
                'avatar_url' => $user['avatar_url'],
            );
        }

        foreach($docsContributors as $key=>$contributor) {
            $user = $client->api('user')->show($contributor['login']);
            $contributors[$contributor['login']] = array(
                'name'       => ($user['name']) ? $user['name'] : $contributor['login'],
                'html_url'   => $user['html_url'],
                'avatar_url' => $user['avatar_url'],
            );
        }

        return $this->render('SymfonySiMainBundle:Default:contributors.html.twig', array(
            'contributors' => $contributors
        ));
    }

    public function resourcesAction()
    {
        $file = __DIR__.'/../../../../resources/README.md';
        $content = (file_exists($file)) ? file_get_contents($file) : '<h1>Symfony resources</h1>';
        $html = $this->container->get('markdown.parser')->transformMarkdown($content);

        return $this->render('SymfonySiMainBundle:Default:resources.html.twig', array('html' => $html));
    }
}
