<?php
/**
 * Created by PhpStorm.
 * User: ap
 * Date: 10.05.15
 * Time: 21:38
 */

namespace ReactBundle\Services;


class ReactJSFactory
{
    /**
     * @param string $appScript
     * @return ReactJS
     */
    public function create($appScript)
    {
        return new ReactJS($appScript);
    }
}