<?php

namespace ESign\Response\SignFlows;

use ESign\Response\Response;

class ExecuteUrl extends Response
{
    private $url;

    private $shortUrl;

    public function resolve(): Response
    {
        parent::resolve();
        if ($this->isSuccess()) {
            $this->url = $this->body['url'] ?? '';
            $this->shortUrl = $this->body['shortUrl'] ?? '';
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getShortUrl()
    {
        return $this->shortUrl;
    }


}
