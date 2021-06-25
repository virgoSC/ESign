<?php

namespace ESign\Response\File;

use ESign\Response\Response;

class DocTemplates extends Response
{

    private $templateId;

    private $templateName;

    private $downloadUrl;

    private $fileSize;

    private $createTime;

    private $updateTime;

    private $structComponents;

    public function resolve(): Response
    {
        parent::resolve();

        if (!$this->isSuccess()) {
            return $this;
        }

        $this->templateId = $this->body['templateId'] ?? '';
        $this->templateName = $this->body['templateName'] ?? '';
        $this->downloadUrl = $this->body['downloadUrl'] ?? '';
        $this->fileSize = $this->body['fileSize'] ?? '';
        $this->createTime = $this->body['createTime'] ?? '';
        $this->updateTime = $this->body['updateTime'] ?? '';
        $this->structComponents = $this->body['structComponents'] ?? [];

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplateId()
    {
        return $this->templateId;
    }

    /**
     * @return mixed
     */
    public function getTemplateName()
    {
        return $this->templateName;
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
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @return mixed
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @return mixed
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * @return mixed
     */
    public function getStructComponents()
    {
        return $this->structComponents;
    }


}
