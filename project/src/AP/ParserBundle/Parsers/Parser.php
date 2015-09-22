<?php
/**
 * Created by Alexander Pobereznichenko.
 * Date: 04.08.15
 * Time: 22:53
 */

namespace AP\ParserBundle\Parsers;


use OldSound\RabbitMqBundle\RabbitMq\Producer;

class Parser
{
    const PARSER_SOURCE_HOTLINE = 'hotline';

    const PARSE_TYPE_POSITION = 'position';
    const PARSE_TYPE_CATALOG = 'catalog';
    const PARSE_TYPE_CATALOG_PAGE = 'catalog_page';

    /**
     * @var Producer
     */
    private $producer;

    public function __construct(Producer $producer)
    {
        $this->producer=$producer;
    }

    public function parse($sourceType, $sourceUrl)
    {
        $this->producer->publish('Hello world');
//        switch ($sourceType) {
//            case self::PARSE_TYPE_CATALOG:
//                $this
//        }
    }

    private function parseCatalog($sourceUrl)
    {

    }

    private function getDataProvider($source)
    {
        switch ($source) {
            case self::PARSER_SOURCE_HOTLINE:
                return new HotlineProvider();
        }

        throw new \Exception('Unsupported source for parsing');
    }
}