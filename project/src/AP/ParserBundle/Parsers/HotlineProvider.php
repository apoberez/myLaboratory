<?php
/**
 * Created by Alexander Pobereznichenko.
 * Date: 04.08.15
 * Time: 22:51
 */

namespace AP\ParserBundle\Parsers;


use AP\ParserBundle\Models\Position;
use Symfony\Component\DomCrawler\Crawler;

class HotlineProvider implements DataProviderInterface
{
    const HOTLINE_BASE_URL = 'http://hotline.ua';

    /**
     * @param string $page
     * @param string $baseUrl
     * @return array
     */
    public function getCatalogPages($page, $baseUrl)
    {
        $result = [$baseUrl];
        $crawler = new Crawler($page);

        $pagerNode = $crawler->filter('.pager.top span');
        $pagerText= $pagerNode->count() ? $pagerNode->text() : '';
        $pages = $pagerText ? (int) end(explode(' ', $pagerText)) : 0;

        for($i = 1; $i < $pages; $i++) {
            $result[] = $baseUrl . '?p=' . $i;
        }

        return $result;
    }

    /**
     * @param string $page
     * @param $category
     * @return \AP\ParserBundle\Models\Position[]
     */
    public function getCatalogPagePositions($page, $category)
    {
        $crawler = new Crawler($page);
        $result = [];

        $positionNodes = $crawler->filter('.catalog > li');

        foreach ($positionNodes as $node) {
            $crawler->clear();
            $crawler->addNode($node);
            $a = $crawler->filter('.title-box a');

            if($a->count() > 0) {
                $position = new Position();
                $position->setTitle(trim($a->text()))
                    ->setSrc(self::HOTLINE_BASE_URL . trim($a->attr('href')))
                    ->setCategory($category);
                $result[] = $position;
            }
        }

        return $result;
    }

    /**
     * @param Position $position
     * @param string $content
     */
    public function getPositionData(Position $position, $content)
    {
        $crawler = new Crawler($content);
        $trs = $crawler->filter('#full-props-list tr');
        $data = [];

        if($trs->count() > 0) {
            foreach($trs as $tr) {
                $crawler->clear();
                $crawler->addNode($tr);

                $th = $crawler->filter('th');
                $td = $crawler->filter('td');

                if($th->count() > 0 && $td->count() > 0) {
                    $data[trim($th->text())] = trim($td->text());
                }
            }
        }

        $position->setAttributes($data);
    }
}