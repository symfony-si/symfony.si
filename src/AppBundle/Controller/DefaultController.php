<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Cache(expires="tomorrow", public=true)
     */
    public function indexAction()
    {
        $posts = $this->get('AppBundle\Repository\PostRepository')->findLatest();

        $jsonData = json_decode(file_get_contents('http://knpbundles.com/newest.json'), true);

        return $this->render('default/index.html.twig', [
            'posts' => $posts,
            'bundles' => $jsonData['results']
        ]);
    }

    /**
     * @Route("/copyrights", name="copyrights")
     * @param Request $request
     * @return Response
     */
    public function copyrightAction(Request $request)
    {
        return $this->render('default/copyright.html.twig');
    }

    /**
     * @Route("/join-us", name="join")
     * @param Request $request
     * @return Response
     */
    public function joinAction(Request $request)
    {
        return $this->render('default/join.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     * @Cache(maxage="20", public=true)
     *
     * @param Request $request
     * @return RedirectResponse|Response
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

        if($form->isSubmitted() && $form->isValid()) {
            // send email to admin
            $message = \Swift_Message::newInstance()
                ->setSubject('Message from Symfony.si')
                ->setFrom($contact->getEmail())
                ->setTo($this->container->getParameter('symfonysi_admin_email'))
                ->setBody(
                    $this->renderView(
                        'emails/email.txt.twig',
                        [
                            'name' => $contact->getName(),
                            'email' => $contact->getEmail(),
                            'message' => $contact->getMessage()
                        ]
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
     * @return Response
     */
    public function contactSuccessAction(Request $request)
    {
        return $this->render('default/contactSuccess.html.twig');
    }

    /**
     * @Route("/contributors", name="contributors")
     * @param Request $request
     * @return Response
     */
    public function contributorsAction(Request $request)
    {
        $cache = $this->get('cache.app');
        $contributorsFromCache = $cache->getItem('app.contributors');
        if (!$contributorsFromCache->isHit()) {
            $client = new \Github\Client();

            $repos = [
                ['symfony-si', 'symfony.si'],
                ['symfony-si', 'symfony-must-watch'],
                ['symfony-si', 'symfony-resources'],
                ['symfony-si', 'symfony-cheatsheet'],
            ];
            $contributors = [];
            foreach ($repos as $repo) {
                $organizationApi = $client->api('repo');
                $paginator = new \Github\ResultPager($client);
                $parameters = [$repo[0], $repo[1]];
                $repoContributors = $paginator->fetchAll($organizationApi, 'contributors', $parameters);
                foreach ($repoContributors as $contributor) {
                    $contributors[$contributor['login']] = [
                        'html_url' => $contributor['html_url'],
                        'avatar_url' => $contributor['avatar_url'],
                        'contributions' => (isset($contributors[$contributor['login']]['contributions'])) ? $contributors[$contributor['login']]['contributions'] + $contributor['contributions'] : $contributor['contributions'],
                    ];
                }
            }

            uasort($contributors, function($a, $b) {
                return $a['contributions'] <=> $b['contributions'];
            });

            $contributors = array_reverse($contributors);

            $contributorsFromCache->set($contributors);
            $cache->save($contributorsFromCache);
        } else {
            $contributors = $contributorsFromCache->get();
        }

        return $this->render('default/contributors.html.twig', [
            'contributors' => $contributors
        ]);
    }

    /**
     * @Route("/resources", name="resources")
     * @param Request $request
     * @return Response
     */
    public function resourcesAction(Request $request)
    {
        $file = $this->get('kernel')->getRootDir().'/../vendor/symfony-si/symfony-resources/README.md';
        $content = (file_exists($file)) ? file_get_contents($file) : '<h1>Symfony resources</h1>';

        return $this->render('default/resources.html.twig', ['html' => $content]);
    }

    /**
     * @Route("/cheatsheet", name="cheatsheet")
     * @return Response
     */
    public function cheatsheetAction()
    {
        $file = $this->get('kernel')->getRootDir().'/../vendor/symfony-si/symfony-cheatsheet/README.md';
        $content = (file_exists($file)) ? file_get_contents($file) : '<h1>Symfony cheat sheet</h1>';

        return $this->render('default/cheatsheet.html.twig', ['html' => $content]);
    }

    /**
     * @Route("/ecosystem", name="ecosystem")
     * @return Response
     */
    public function ecosystemAction()
    {
        $projects = [];
        $project = new Project();
        $project->setTitle('Symfony Framework');
        $project->setDescription('Prevod ogrodja Symfony');
        $project->setLink('https://github.com/symfony/symfony');
        $project->setRepository('https://github.com/symfony/symfony');
        $project->setSlug('symfony');
        $projects[] = $project;

        $project = new Project();
        $project->setTitle('Symfony.com');
        $project->setDescription('Symfony.com website');
        $project->setLink('https://github.com/symfony/symfony-marketing');
        $project->setRepository('https://github.com/symfony/symfony-marketing');
        $project->setSlug('symfony-marketing');
        $projects[] = $project;

        $project = new Project();
        $project->setTitle('Sonata Project');
        $project->setDescription('Prevod projekta Sonata Project');
        $project->setLink('https://github.com/sonata-project');
        $project->setRepository('https://github.com/sonata-project');
        $project->setSlug('sonata-project');
        $projects[] = $project;

        $project = new Project();
        $project->setTitle('EasyAdminBundle');
        $project->setDescription('Prevod Symfony paketa EasyAdminBundle');
        $project->setLink('https://github.com/javiereguiluz/EasyAdminBundle');
        $project->setRepository('https://github.com/javiereguiluz/EasyAdminBundle');
        $project->setSlug('easy-admin-bundle');
        $projects[] = $project;

        $project = new Project();
        $project->setTitle('PHP: The Right Way');
        $project->setDescription('An easy-to-read, quick reference for PHP best practices, accepted coding standards, and links to authoritative tutorials around the Web');
        $project->setLink('http://sl.phptherightway.com');
        $project->setRepository('https://github.com/symfony-si/php-the-right-way');
        $project->setSlug('php-the-right-way');
        $projects[] = $project;

        $project = new Project();
        $project->setTitle('PHP FIG');
        $project->setDescription('PHP Standards Recommendations');
        $project->setLink('http://php-fig.org');
        $project->setRepository('https://github.com/php-fig/fig-standards');
        $project->setSlug('php-fig-standards');
        $projects[] = $project;

        $project = new Project();
        $project->setTitle('Magento');
        $project->setDescription('Magento 1.x Translation');
        $project->setLink('http://magento.com/');
        $project->setRepository('https://github.com/symfony-si/magento1-sl-si');
        $project->setSlug('magento1');
        $projects[] = $project;

        $project = new Project();
        $project->setTitle('Magento 2');
        $project->setDescription('Magento 2.x Translation');
        $project->setLink('http://magento.com/');
        $project->setRepository('https://github.com/symfony-si/magento2-sl_si');
        $project->setSlug('magento2');
        $projects[] = $project;

        $project = new Project();
        $project->setTitle('Semver.org');
        $project->setDescription('Semantic Versions');
        $project->setLink('http://semver.org/lang/sl');
        $project->setRepository('https://github.com/mojombo/semver.org');
        $project->setSlug('semantic-versioning');
        $projects[] = $project;

        $project = new Project();
        $project->setTitle('The PHP League');
        $project->setDescription('Slovenski prevod strani PHP lige paketov');
        $project->setLink('http://thephpleague.com/sl/');
        $project->setRepository('https://github.com/thephpleague/thephpleague.github.io');
        $project->setSlug('the-php-league');
        $projects[] = $project;

        $project = new Project();
        $project->setTitle('Yii framework');
        $project->setDescription('Slovenski prevod ogrodja Yii 2');
        $project->setLink('https://github.com/yiisoft/yii2');
        $project->setRepository('https://github.com/yiisoft/yii2');
        $project->setSlug('the-php-league');
        $projects[] = $project;

        $project = new Project();
        $project->setTitle('Progit');
        $project->setDescription('Slovenski prevod knjige progit');
        $project->setLink('http://git-scm.com/book/sl');
        $project->setRepository('https://github.com/progit/progit2-sl');
        $project->setSlug('progit');
        $projects[] = $project;

        $project = new Project();
        $project->setTitle('Zend Framework 2');
        $project->setDescription('Slovenian translation of Zend Framework 2');
        $project->setLink('https://github.com/zendframework/zf2');
        $project->setRepository('https://github.com/zendframework/zf2');
        $project->setSlug('zend-framework-2');
        $projects[] = $project;

        return $this->render(
            'default/ecosystem.html.twig',
            ['projects' => $projects]
        );
    }

    /**
     * @Route("/code-of-conduct", name="conduct")
     * @Cache(expires="tomorrow", public=true)
     *
     * @return Response
     */
    public function conductAction()
    {
        $file = $this->get('kernel')->getRootDir().'/../vendor/symfony-si/conduct/README.md';
        $content = (file_exists($file)) ? file_get_contents($file) : '<h1>Symfony.si Code of Conduct</h1>';

        return $this->render('default/conduct.html.twig', ['content' => $content]);
    }
}
