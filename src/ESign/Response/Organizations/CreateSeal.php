<?php

namespace ESign\Response\Organizations;

use ESign\Response\Response;

class CreateSeal extends Response
{
    private $sealId;
    private $fileKey;
    private $url;

    public function resolve(): Response
    {
        parent::resolve();

        if ($this->isSuccess()) {
            $this->sealId = $this->body['sealId'] ?? '';
            $this->fileKey = $this->body['fileKey'] ?? '';
            $this->url = $this->body['url'] ?? '';
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSealId()
    {
        return $this->sealId;
    }

    /**
     * @return mixed
     */
    public function getFileKey()
    {
        return $this->fileKey;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }


}
