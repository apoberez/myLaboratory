<?php
/**
 * Created by PhpStorm.
 * User: ap
 * Date: 17.04.15
 * Time: 23:13
 */

namespace UserBundle\Controller;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Document\User;
use UserBundle\Form\RegistrationType;
use UserBundle\ReactComponents;

class SecurityController extends Controller
{
    public function registrationPageAction()
    {
        $react = $this->get('react_factory')
            ->create(file_get_contents($this->container->getParameter('kernel.root_dir') . '/../web/dist/js/components.js'));
        $react->setComponent(ReactComponents::REGISTRATION_FORM, ['test' => 'Hello, world!!!']);
//        $regForm = $react->getMarkup();

        return $this->render('UserBundle:Security:registration.html.twig', ['regForm' => 'form']);
    }

    public function accountCreateAction(Request $request)
    {
        /** @var ObjectManager $em */
        $em = $this->get('doctrine_mongodb')->getManager();
        $form = $this->createForm(new RegistrationType(), new User());
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $em->persist($user);
            $em->flush();
            return new JsonResponse();
        } else {
            return new JsonResponse(['message' => 'Bad request', 'errors' => $this->handleFormErrors($form)], 400);
        }
    }

    private function handleFormErrors(Form $form)
    {
        $errors = [];
        foreach($form->getErrors(true) as $error) {
            /** @var FormError $error */
            $fieldName = $error->getOrigin()->getName();
            if (!isset($errors[$fieldName])) {
                $errors[$fieldName] = [];
            }
            array_push($errors[$fieldName], $error->getMessage());
        }
        return $errors;
    }
}