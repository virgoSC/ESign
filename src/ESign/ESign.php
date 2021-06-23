<?php

namespace ESign;

use Exception;

/**
 * Class ESign
 * @method uploadUrl(string $dist)
 * @package ESign
 */
class ESign
{

    protected $config;

    /**
     * @throws Exception
     */
    public function __construct($options)
    {
        $this->config = new Config($options['appId'] ?? '', $options['secret'] ?? '', $options['host'] ?? '');;
    }

    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
    }
}
