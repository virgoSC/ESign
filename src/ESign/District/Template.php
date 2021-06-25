<?php

namespace ESign\District;

use ESign\Response\File\CreateByUploadUrl;
use ESign\Response\File\DocTemplates;
use ESign\Response\File\FileUpload;
use ESign\UrlSet;
use Exception;

/**
 * 文件模板类Api
 * Class Template
 * @package ESign\District
 */
class Template extends District
{
    /**
     * 通过上传方式创建模板
     * @throws Exception
     */
    public function createByFile($fileDir): self
    {
        $this->setUrl(UrlSet::$set['createTemplateByFile']);

        $this->setMethod(self::$POST);

        $this->setResponse(CreateByUploadUrl::class);

        if (!is_file($fileDir)) {
            throw new Exception($fileDir . 'not is file');
        }

        $file = fopen($fileDir, 'r');
        $header = fread($file, '4');
        $name = basename($fileDir);

        if ($header != '%PDF') {
            $turnPDF = true;
        } else {
            $turnPDF = false;
        }

        $this->setParameter([
            'contentMd5' => Common::fileBase64Md5($fileDir),
            'contentType' => 'application/octet-stream',
            'fileName' => $name,
            'convert2Pdf' => $turnPDF,
        ]);
        return $this;
    }

    /**
     * 模板详情
     * @param string $templateId
     * @return $this
     */
    public function docTemplates(string $templateId): self
    {
        $url = UrlSet::$set['templatesStatus'];
        $url = str_replace('{templateId}', $templateId, $url);

        $this->setUrl($url);

        $this->setMethod(self::$GET);

        $this->setResponse(DocTemplates::class);

        return $this;
    }

    /**
     * 添加输入项组件
     * @param string $templateId
     * @param StructComponent $component
     * @return $this
     * @throws Exception
     */
    public function templatesComponents(string $templateId, StructComponent $component): self
    {
        $url = UrlSet::$set['templatesComponents'];

        $url = str_replace('{templateId}', $templateId, $url);

        $this->setUrl($url);

        $this->setMethod(self::$POST);

        $this->setResponse(CreateByUploadUrl::class);

        $this->setParameter([
            'templateId' => $templateId,
            'structComponent' => $component->generate()
        ]);
        return $this;
    }

    public function fileStatus(string $fileId): self
    {
        $url = UrlSet::$set['fileStatus'];
        $url = str_replace('{fileId}', $fileId, $url);

        $this->setUrl($url);

        $this->setMethod(self::$GET);

        $this->setResponse(CreateByUploadUrl::class);

        return $this;
    }

    /**
     * @throws Exception
     */
    public function fileUpload(string $fileDir, string $url)
    {
        $this->setUrl($url, false);

        $this->setMethod(self::$PUT);

        $this->setResponse(FileUpload::class);

        if (!is_file($fileDir)) {
            throw new Exception($fileDir . 'not is file');
        }

        $this->setHeader([
            'Content-MD5' => Common::fileBase64Md5($fileDir),
            'Content-Type' => 'application/octet-stream',
        ]);
        $resource = fopen($fileDir, 'r');
        $this->setParameter([$resource]);
        return $this;
    }
}