<?php

namespace ESign\District;

use ESign\UrlSet;
use Exception;

/**
 * 模板类
 * Class Template
 * @package ESign\District
 */
class Template extends District
{
    /**
     * @throws Exception
     */
    public function createByFile($fileDir): self
    {
        $this->url = UrlSet::$set['createByFile'];
        $this->method = self::$POST;

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

        $this->parameter = [
            'contentMd5' => Common::fileBase64Md5($fileDir),
            'contentType' => 'application/octet-stream',
            'fileName' => $name,
            'convert2Pdf' => $turnPDF,
        ];
        return $this;
    }
}