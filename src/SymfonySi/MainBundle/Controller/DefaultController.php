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
        $contributors = json_decode(file_get_contents('https://api.github.com/repos/paradoxcode/symfony.si/contributors'), true);

        foreach($contributors as $key=>$contributor) {
            $jsonData = json_decode(file_get_contents('https://api.github.com/users/' . $contributor['login']), true);
            $contributors[$key]['name'] = ($jsonData['name']) ? $jsonData['name'] : $contributor['login'];
        }

        return $this->render('SymfonySiMainBundle:Default:contributors.html.twig', array(
            'contributors' => $contributors
        ));
    }
}
