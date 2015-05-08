<?php
/**
 * Created by PhpStorm.
 * User: ap
 * Date: 27.03.15
 * Time: 17:59
 */

namespace AP\BlogBundle\Document;


class Post implements \JsonSerializable
{

    /**
     * @var \MongoId $id
     */
    protected $id;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var \DateTime $pubDate
     */
    protected $pubDate;

    /**
     * @var string $content
     */
    protected $content;


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
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set pubDate
     *
     * @param \DateTime $pubDate
     * @return self
     */
    public function setPubDate($pubDate)
    {
        $this->pubDate = $pubDate;
        return $this;
    }

    /**
     * Get pubDate
     *
     * @return \DateTime $pubDate
     */
    public function getPubDate()
    {
        return $this->pubDate;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'pubDate' => $this->getPubDate(),
            'content' => $this->getContent()
        ];
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }


}
