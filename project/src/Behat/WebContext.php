<?php
/**
 * Created by PhpStorm.
 * User: ar
 * Date: 14.03.15
 * Time: 19:07
 */

namespace LB\AppBundle\Features\Context;


use Behat\Mink\Exception\ElementNotFoundException;
use Behat\MinkExtension\Context\MinkContext;

class WebContext extends MinkContext
{
    /**
     * @Given /^I should see exactly "([^"]*)" in the "([^"]*)" element$/
     */
    public function iShouldSeeOnlyInTheElement($text, $selector)
    {
        $element = $this->getElement($selector);

        \PHPUnit_Framework_Assert::assertSame($text, $element->getText());
    }

    /**
     * @Given /^Element \'([^\']*)\' should have attribute \'([^\']*)\' = \'([^\']*)\'$/
     */
    public function elementShouldHaveAttributeEqualTo($selector, $attribute, $value)
    {
        $element = $this->getElement($selector);
        $actualValue = $element->getAttribute($attribute);

        \PHPUnit_Framework_Assert::assertSame($value, $actualValue);
    }

    /**
     * @Given /^Element \'([^\']*)\' should have class \'([^\']*)\'$/
     */
    public function elementShouldHaveClass($selector, $class)
    {
        $element = $this->getElement($selector);
        if (!$element->hasClass($class)) {
            throw new \Exception("Element '$selector' doesn't have class '$class''");
        }
    }

    /**
     * @param $selector
     * @return \Behat\Mink\Element\NodeElement|mixed|null
     * @throws ElementNotFoundException
     */
    private function getElement($selector)
    {
        $element = $this->getSession()->getPage()->find('css', $selector);
        if (!$element) {
            throw new ElementNotFoundException($this->getSession(), null, $selector);
        }
        return $element;
    }

    public function spin ($lambda, $wait = 5)
    {
        for ($i = 0; $i < $wait; $i++)
        {
            try {
                if ($lambda($this)) {
                    return true;
                }
            } catch (\Exception $e) {
                // do nothing
            }

            sleep(1);
        }
        $lambda($this);
        return false;
    }

    /**
     * @Given /^Element with css selector "([^"]*)" is visible$/
     */
    public function elementWithCssSelectorIsVisible($selector)
    {
        $element = $this->getElement($selector);
        \PHPUnit_Framework_Assert::assertTrue($element->isVisible());
    }

    /**
     * @Given /^I click "([^"]*)"$/
     */
    public function iClick($selector)
    {
        $element = $this->getElement($selector);
        $element->click();
    }

    /**
     * @Given /^pause (\d+)$/
     */
    public function pause($time)
    {
        sleep((int)$time);
    }

    /**
     * @Given /^In (.*) seconds I should see "([^"]*)" in the "([^"]*)" element$/
     */
    public function inSecondsIShouldSeeInTheElement($time, $text, $element)
    {
        $this->spin(function ($context) use ($element, $text){
            $element = $this->getSession()->getPage()->find('css', $element);
            $actualText = $element->getText();
            \PHPUnit_Framework_Assert::assertSame($text, $actualText);
            return true;
        }, $time);
    }
}