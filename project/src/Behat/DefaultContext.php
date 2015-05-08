<?php

namespace AP\Behat;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\Symfony2Extension\Driver\KernelDriver;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\SwiftmailerBundle\DataCollector\MessageDataCollector;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Profiler\Profile;

abstract class DefaultContext extends RawMinkContext implements Context, KernelAwareContext
{
    /**
     * @var KernelInterface
     */
    protected $kernel;

    /**
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->getClient()->getResponse();
    }

    /**
     * @return Client
     */
    protected function getClient()
    {
        return $this->getSession()->getDriver()->getClient();
    }

    /**
     * Get service by id.
     *
     * @param string $id
     * @return object
     */
    protected function getService($id)
    {
        return $this->getContainer()->get($id);
    }

    /**
     * Returns Container instance.
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->kernel->getContainer();
    }

    /**
     * @return ContainerInterface
     * @throws UnsupportedDriverActionException
     */
    protected function getClientContainer()
    {
        $driver = $this->getSession()->getDriver();
        if (!$driver instanceof KernelDriver) {
            throw new UnsupportedDriverActionException('Not supported with driver %s', $driver);
        }
        $client = $this->getClient();

        return $client->getContainer();
    }

    protected function getBaseUrl()
    {
        return $this->getContainer()->get('base_url');
    }

    /**
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     */
    protected function getDoctrine()
    {
        return $this->getContainer()->get('doctrine');
    }

    /**
     * Accepts $command input in format "your:symfony:command"
     *
     * @param string $command
     * @return int
     * @throws \Exception
     */
    protected static function runCommand($command)
    {
        $command = sprintf('%s', $command);
        $kernel = new \AppKernel('test', true);
        $kernel->boot();
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new StringInput($command);
        $input->setInteractive(false);

        return $application->run($input);
    }

    /**
     * @return array
     * @throws UnsupportedDriverActionException
     */
    protected function getEmails()
    {
        $mailCollector = $this->getSymfonyProfile();
        /** @var MessageDataCollector $collector */
        $collector = $mailCollector->getCollector('swiftmailer');
        return $collector->getMessages();
    }

    /**
     * @return Profile
     * @throws UnsupportedDriverActionException
     */
    public function getSymfonyProfile()
    {
        $driver = $this->getSession()->getDriver();
        if (!$driver instanceof KernelDriver) {
            throw new UnsupportedDriverActionException(
                'You need to tag the scenario with ' .
                '"@mink:symfony2". Using the profiler is not ' .
                'supported by %s', $driver
            );
        }

        $profile = $driver->getClient()->getProfile();
        if (false === $profile) {
            throw new \RuntimeException(
                'The profiler is disabled. Activate it by setting ' .
                'framework.profiler.only_exceptions to false in ' .
                'your config'
            );
        }

        return $profile;
    }

    /**
     * @param string $html
     * @return Crawler
     */
    protected function createCrawler($html)
    {
        return new Crawler($html);
    }

    protected static function loadFixtures()
    {
        static::runCommand('doctrine:fixtures:load');
    }
}