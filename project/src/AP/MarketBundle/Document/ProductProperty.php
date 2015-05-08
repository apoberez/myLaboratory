<?php
/**
 * Created by PhpStorm.
 * User: ap
 * Date: 02.04.15
 * Time: 23:57
 */

namespace AP\MarketBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 *
 * Class ProductProperty
 * @package AP\MarketBundle\Document
 */
class ProductProperty
{
    /**
     * @MongoDB\Id
     *
     * @var \MongoId $id
     */
    private $id;

    /**
     *  @MongoDB\String
     *
     * @var string $name
     */
    private $name;

    /**
     * @MongoDB\String
     *
     * @var string $label
     */
    private $label;

    /**
     * @MongoDB\String
     *
     * @var string $measure
     */
    private $measure;


    /**
     * Get id
     *
     * @return \MongoId $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param string $measure
     * @return self
     */
    public function setMeasure($measure)
    {
        $this->measure = $measure;
        return $this;
    }

    /**
     * Get value
     *
     * @return string $measure
     */
    public function getMeasure()
    {
        return $this->measure;
    }
}



