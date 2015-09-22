<?php

namespace AP\ParserBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $redis = $this->get('ap_redis.connection')->getRedis();

        $redis->set('sania', 'yes');

        return $this->render('APParserBundle:Default:index.html.twig', array('name' => 'test'));
    }
}
