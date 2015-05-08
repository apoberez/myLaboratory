<?php

namespace AP\BlogBundle\Controller;

use AP\BlogBundle\Document\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('APBlogBundle:Default:index.html.twig', array('name' => 'Alexander'));
    }
}
