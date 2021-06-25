<?php

namespace ESign\District;

use ESign\Response\Response;

class District
{
    public static $GET = 'GET';

    public static $POST = 'POST';

    public static $PUT = 'PUT';

    public static $FORM = 'FORM';


    private $method = 'get';

    private $parameter = [];

    private $header = [];

    private $url = '';

    private $host = '';

    private $useHost = true;

    private $response;


    /**
     * @param $url
     * @param bool $useHost
     * @return District
     */

    public function setUrl($url, bool $useHost = true): self
    {
        $this->url = $url;
        $this->useHost = $useHost;
        return $this;
    }


    public function setHeader(array $header): self
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @param array $parameter
     */
    public function setParameter(array $parameter): void
    {
        $this->parameter = $parameter;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }


    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }


    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @return array
     */
    public function getParameter(): array
    {
        return $this->parameter;
    }

    public function getUrl(): string
    {
        if ($this->useHost) {
            return $this->host . $this->url;
        } else {
            return $this->getRoute();
        }
    }

    public function getRoute(): string
    {
        return $this->url;
    }

    public function setBaseUrl($baseUrl): self
    {
        $this->host = trim($baseUrl, '/');;
        return $this;
    }

    public function setResponse($className): self
    {
        $this->response = $className;
        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
