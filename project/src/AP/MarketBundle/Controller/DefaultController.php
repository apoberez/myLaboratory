<?php

namespace AP\MarketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('APMarketBundle:Default:index.html.twig', array('name' => $name));
    }
}
