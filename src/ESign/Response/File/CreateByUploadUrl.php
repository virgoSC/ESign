<?php

namespace ESign\Response\File;

use ESign\Response\Response;

/**
 * 文件上传模板
 * Class CreateByUploadUrl
 * @package ESign\Response\File
 */
class CreateByUploadUrl extends Response
{
    private $templateId;

    private $uploadUrl;

    public function resolve(): Response
    {
        parent::resolve();

        if ($this->isSuccess()) {
            $this->templateId = $this->body['templateId'] ?? '';
            $this->uploadUrl = $this->body['uploadUrl'] ?? '';
        }
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
    public function getUploadUrl()
    {
        return $this->uploadUrl;
    }


}