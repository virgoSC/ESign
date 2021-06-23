<?php

namespace ESign\District;

class Common
{
    public static function Base64Md5($filePath) {
        //获取文件MD5的128位二进制数组
        $md5file = md5_file($filePath,true);
        //计算文件的Content-MD5
        $contentBase64Md5 = base64_encode($md5file);
        echo ("contentBase64Md5=".$contentBase64Md5);
        return $contentBase64Md5;
    }
}
