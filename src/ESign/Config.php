<?php

namespace ESign;

use Exception;

class Config
{
    private $appId;

    private $secret;

    private $host;

    /**
     * @throws Exception
     */
    public function __construct($appId, $secret, $host)
    {
        $this->appId = $appId;
        $this->secret = $secret;
        $this->host = $host;

        if (!$this->appId or !$this->secret or !$this->host) {
            throw new Exception('配置异常');
        }
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return mixed
     */
    public function getSecret() :string
    {
        return $this->secret;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }


}
