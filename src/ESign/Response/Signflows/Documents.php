<?php

namespace ESign\Response\SignFlows;

use ESign\Response\Response;

class Documents extends Response
{
    private $fileId;

    private $fileName;

    private $fileUrl;


    public function resolve(): Response
    {
        parent::resolve();
        if ($this->isSuccess()) {

            $this->fileId = $this->body['docs'][0]['fileId'] ?? '';
            $this->fileName = $this->body['docs'][0]['fileName'] ?? '';
            $this->fileUrl = $this->body['docs'][0]['fileUrl'] ?? '';
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return mixed
     */
    public function getFileUrl()
    {
        return $this->fileUrl;
    }



}
