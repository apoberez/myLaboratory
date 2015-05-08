<?php
/**
 * Created by PhpStorm.
 * User: ap
 * Date: 17.04.15
 * Time: 23:13
 */

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Document\User;
use UserBundle\Form\RegistrationType;

class SecurityController extends Controller
{
    public function registrationPageAction()
    {
        return $this->render('UserBundle:Security:registration.html.twig');
    }

    public function accountCreateAction(Request $request)
    {
        $em = $this->get('doctrine_mongodb')->getManager();

        $form = $this->createForm(new RegistrationType(), new User());

        $form->handleRequest($request);

//        if ($form->isValid()) {
//            dump($form->getData());die;
//            $registration = $form->getData();
//
//            $em->persist($registration->getUser());
//            $em->flush();
//        }
//
//        dump($request);die;
        return new JsonResponse();
    }
}