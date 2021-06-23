<?php

namespace ESign\District;

/**
 * 模板类
 * Class Template
 * @package ESign\District
 */
class Template
{
    public function createByFile($file,$isPDF)
    {
        return [
            'contentMd5' => Common::Base64Md5($file),
            'contentType' => 'application/octet-stream',
            'convert2Pdf' => (bool)$isPDF ? 'false' : 'true',
            'fileName' => $file,
            'fileSize' => $file
        ];
    }
}