<?php
/**
 * Created by PhpStorm.
 * User: ap
 * Date: 27.03.15
 * Time: 12:51
 */

namespace AP\BlogBundle\Features\bootstrap;


use AP\Behat\ApiContext;
use AP\BlogBundle\Document\Post;
use Behat\Gherkin\Node\TableNode;
use Doctrine\ODM\MongoDB\DocumentManager;

class PostContext extends ApiContext
{
    /**
     * @Given /^there are following Posts:$/
     */
    public function thereIsFollowingPosts(TableNode $table)
    {
        /** @var DocumentManager $dm */
        $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();

        $dm->createQueryBuilder('APBlogBundle:Post')
            ->remove()
            ->getQuery()
            ->execute();

        foreach ($table->getHash() as $row) {
            $post = new Post();
            $post->setPubDate(\DateTime::createFromFormat('Y-m-d', $row['pubDate']))
                ->setTitle($row['title'])
                ->setContent($row['content']);
            $dm->persist($post);
        }
        $dm->flush();
    }
}