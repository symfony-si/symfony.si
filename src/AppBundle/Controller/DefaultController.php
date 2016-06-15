<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Contact;
use League\CommonMark\CommonMarkConverter;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('SymfonySiBlogBundle:Post');

        $q = $repository->createQueryBuilder('p')
            ->orderBy('p.created', 'DESC')
            ->setMaxResults(10)
            ->getQuery();

        $posts = $q->getResult();

        $jsonData = json_decode(file_get_contents('http://knpbundles.com/newest.json'), true);

        return $this->render('default/index.html.twig', [
            'posts' => $posts,
            'bundles' => $jsonData['results']
        ]);
    }

    /**
     * @Route("/copyrights", name="copyrights")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function copyrightAction(Request $request)
    {
        return $this->render('default/copyright.html.twig');
    }

    /**
     * @Route("/join-us", name="join")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function joinAction(Request $request)
    {
        return $this->render('default/join.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->createFormBuilder($contact)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class)
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
                        'emails/email.txt.twig',
                        array(
                            'name' => $contact->getName(),
                            'email' => $contact->getEmail(),
                            'message' => $contact->getMessage()
                        )
                    )
                )
            ;
            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('contact_success'));
        }

        return $this->render('default/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contact-succeeded", name="contact_success")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactSuccessAction(Request $request)
    {
        return $this->render('default/contactSuccess.html.twig');
    }

    /**
     * @Route("/contributors", name="contributors")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contributorsAction(Request $request)
    {
        $cache = $this->get('kernel')->getRootDir().'/../var/cache/github-api-cache';
        $client = new \Github\Client(
            new \Github\HttpClient\CachedHttpClient(['cache_dir' => $cache])
        );
        $srcContributors = $client->api('repo')->contributors('symfony-si', 'symfony.si');
        $docsContributors = $client->api('repo')->contributors('symfony-si', 'symfony-docs-sl');
        $contributors = [];

        foreach($srcContributors as $key=>$contributor) {
            $user = $client->api('user')->show($contributor['login']);
            $contributors[$contributor['login']] = [
                'name'       => ($user['name']) ? $user['name'] : $contributor['login'],
                'html_url'   => $user['html_url'],
                'avatar_url' => $user['avatar_url'],
            ];
        }

        foreach($docsContributors as $key=>$contributor) {
            $user = $client->api('user')->show($contributor['login']);
            $contributors[$contributor['login']] = [
                'name'       => ($user['name']) ? $user['name'] : $contributor['login'],
                'html_url'   => $user['html_url'],
                'avatar_url' => $user['avatar_url'],
            ];
        }

        return $this->render('default/contributors.html.twig', [
            'contributors' => $contributors
        ]);
    }

    /**
     * @Route("/resources", name="resources")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resourcesAction(Request $request)
    {
        $file = __DIR__.'/../../../resources/README.md';
        $content = (file_exists($file)) ? file_get_contents($file) : '<h1>Symfony resources</h1>';
        $html = $this->container->get('markdown.parser')->transformMarkdown($content);

        return $this->render('default/resources.html.twig', ['html' => $html]);
    }

    /**
     * @Route("/cheatsheet", name="cheatsheet")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cheatsheetAction()
    {
        $file = __DIR__.'/../../../cheatsheet/README.md';
        $content = (file_exists($file)) ? file_get_contents($file) : '<h1>Symfony cheat sheet</h1>';

        $converter = new CommonMarkConverter();
        $html = $converter->convertToHtml($content);

        return $this->render('default/cheatsheet.html.twig', ['html' => $html]);
    }
}
