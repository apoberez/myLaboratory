<?php
/**
 * Created by Alexander Pobereznichenko.
 * Date: 25.08.15
 * Time: 22:16
 */

namespace AP\RedisBundle;


class Connection implements ConnectionInterface
{
    private $host;

    private $port;

    private $redis;

    public function __construct($host, $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @return \Redis
     */
    public function getRedis()
    {
        if (!$this->redis) {
            $redis = new \Redis();
            $redis->connect($this->host, $this->port);
            $this->redis = $redis;
        }

        return $this->redis;
    }
}