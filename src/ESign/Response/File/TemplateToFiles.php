<?php

namespace ESign\Response\File;

use ESign\Response\Response;

class TemplateToFiles extends Response
{
    private $downloadUrl;

    private $fileId;

    private $fileName;

    public function resolve(): Response
    {
        parent::resolve();
        $this->downloadUrl = $this->body['downloadUrl'];
        $this->fileId = $this->body['fileId'];
        $this->fileName = $this->body['fileName'];

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDownloadUrl()
    {
        return $this->downloadUrl;
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


}
