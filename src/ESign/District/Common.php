<?php

namespace ESign\District;

class Common
{
    public static function fileBase64Md5($filePath): string
    {
        //获取文件MD5的128位二进制数组
        $md5file = md5_file($filePath, true);
        //计算文件的Content-MD5
        return base64_encode($md5file);
    }

    public static function base64Md5($param): string
    {
        if (is_array($param)) {
            if ($param) {
                $param = json_encode($param, JSON_UNESCAPED_SLASHES);
            } else {
                $param = null;
            }
        }
        return base64_encode(md5($param, true));
    }
}
