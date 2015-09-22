<?php
/**
 * Created by Alexander Pobereznichenko.
 * Date: 25.08.15
 * Time: 21:48
 */

namespace AP\ParserBundle\Features\bootstrap;


use Behat\Behat\Context\Context;

class ParserContext implements Context
{

    /**
     * @Given /^behat warks$/
     */
    public function behatWarks()
    {
        var_dump('yes');
    }
}