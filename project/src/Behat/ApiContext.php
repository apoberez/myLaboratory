<?php
/**
 * Created by PhpStorm.
 * User: ap
 * Date: 27.03.15
 * Time: 19:45
 */

namespace AP\Behat;



class ApiContext extends DefaultContext
{
    /**
     * @When /^I make (.*) request to (.*)$/
     *
     * @param $method
     * @param $url
     */
    public function iMakeRequestTo($method, $url)
    {
        $this->getClient()->request($method, $url, [], [], ['CONTENT_TYPE' => 'application/json']);
    }
}