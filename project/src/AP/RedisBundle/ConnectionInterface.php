<?php
/**
 * Created by Alexander Pobereznichenko.
 * Date: 25.08.15
 * Time: 22:19
 */

namespace AP\RedisBundle;


interface ConnectionInterface {
    /**
     * @return \Redis
     */
    public function getRedis();
}