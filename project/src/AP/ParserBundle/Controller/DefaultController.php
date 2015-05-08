<?php

namespace AP\ParserBundle\Controller;

use AP\MarketBundle\Document\Product;
use AP\MarketBundle\Document\ProductProperty;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;

class DefaultController extends Controller
{
    public function indexAction()
    {
//        $client = new Client();
//        $response = $client->get('http://hotline.ua/computer-planshety/goclever-quantum-700/');
//        $crawler = new Crawler($response->getBody()->getContents());
//
//        $trs = $crawler->filter('#full-props-list tr');
//
//
//        $data = $trs->each(function($node, $i){
//            /** @var Crawler $node */
//            if($node->filter('td')->count() > 0){
//                return [
//                    'name' => trim($node->filter('th')->text()),
//                    'value' => trim($node->filter('td')->text()),
//                ];
//            }
//            return null;
//        });
//
//
//        dump($data);die;

        $property = new ProductProperty();
        $property->setName('test')
            ->setMeasure('sdfa');

        $property2 = new ProductProperty();
        $property2->setName('test2')
            ->setMeasure('sdfsfafa');

        $product = new Product();
        $product->setProperties([$property, $property2]);

        $manager = $this->get('doctrine_mongodb')->getManager();

//        dump($product);die;
//        $manager->persist($property);
//        $manager->persist($property2);
        $manager->persist($product);
        $manager->flush();

        return $this->render('APParserBundle:Default:index.html.twig', array('name' => 'test'));
    }
}
