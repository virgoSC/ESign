<?php

namespace ESign\District;

class District
{
    public static $GET = 'GET';

    public static $POST = 'POST';

    public static $PUT = 'PUT';

    public static $FORM = 'FORM';


    protected $method = 'get';

    protected $parameter = [];

    protected $url = '';

    protected $host = '';

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParameter(): array
    {
        return $this->parameter;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->host . $this->url;
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


}
