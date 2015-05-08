<?php
/**
 * Created by PhpStorm.
 * User: ar
 * Date: 26.03.15
 * Time: 10:55
 */

namespace LB\AppBundle\Features\Context;


use Behat\Gherkin\Node\TableNode;

class ApiDefaultContext extends DefaultContext
{

    /**
     * @param string $url
     * @param array $data
     */
    protected function postRequest($url, array $data)
    {
        $client = $this->getClient();
        $client->request(
            'POST',
            $this->getContainer()->getParameter('test.base_url') . $url,
            $data,
            array(),
            array('CONTENT_TYPE' => 'application/json')
        );
    }

    /**
     * @Then /^Response status code should be (.*)$/
     */
    public function responseStatusCodeShouldBe($response_status)
    {
        \PHPUnit_Framework_Assert::assertEquals((int)$response_status, $this->getResponse()->getStatusCode());
    }

    /**
     * @When /^I make post request to \'([^\']*)\' with data:$/
     */
    public function iMakePostRequestToWithData1($url, TableNode $table)
    {
        $data = $table->getHash()[0];
        $dataHandled = [];
        foreach($data as $parameter => $value){
            $array = explode('::', $parameter);
            if(preg_match('/\d{4}-\d{1,2}-\d{1,2}/', $value)){
                $date = ['year', 'month', 'day'];
                $value = explode('-', $value);
                $value = array_combine($date, $value);
            }
            if(count($array) === 2) {
                $dataHandled[$array[0]][$array[1]] = $value;
                continue;
            }
            if(count($array) === 3) {
                $dataHandled[$array[0]][$array[1]][$array[2]] = $value;
                continue;
            }
            $dataHandled[$parameter] = $value;
        }
        $this->postRequest($url, $dataHandled);
    }

    /**
     * @Given /^I should receive message: (.*)$/
     */
    public function iShouldReceive($message)
    {
        $data = json_decode($this->getResponse()->getContent());
        $receivedMessage = (isset($data->message)) ? $data->message : 'none';
        \PHPUnit_Framework_Assert::assertContains($message, $receivedMessage, 'Wrong error message');
    }

    /**
     * @Then /^Email on address (.*) must be sent$/
     */
    public function emailOnAddressMustBeSent($address)
    {
        $emails = $this->getEmails();
        if (!$emails) {
            throw new \Exception('Email not sent');
        }
        /** @var \Swift_Message $message */
        $message = $emails[0];

        \PHPUnit_Framework_Assert::assertContains($address, trim(current($message->getTo())));
    }
}