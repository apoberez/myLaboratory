<?php
/**
 * Created by Alexander Pobereznichenko.
 * Date: 05.08.15
 * Time: 0:07
 */

namespace AP\ParserBundle\Rabbit;


use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class ParserConsumer implements ConsumerInterface
{
    public function __construct()
    {
    }


    /**
     * @param AMQPMessage $msg The message
     * @return mixed false to reject and requeue, any other value to aknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        // TODO: Implement execute() method.
        var_dump($msg->body);
    }
}