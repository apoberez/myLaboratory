<?php
/**
 * Created by Alexander Pobereznichenko.
 * Date: 05.08.15
 * Time: 21:09
 */

namespace AP\ParserBundle\Parsers;


use AP\ParserBundle\Models\Position;

interface DataProviderInterface
{
    /**
     * @param string $page
     * @param string $baseUrl
     * @return array
     */
    public function getCatalogPages($page, $baseUrl);

    /**
     * @param string $page
     * @param $category
     * @return \AP\ParserBundle\Models\Position[]
     */
    public function getCatalogPagePositions($page, $category);

    /**
     * @param Position $position
     * @param string $page
     */
    public function getPositionData(Position $position, $page);
}