<?php

namespace ESign;

class UrlSet {
    public static $set = [
        'createTemplateByFile' => '/v1/docTemplates/createByUploadUrl', //通过上传方式创建模板
        'fileStatus' => '/v1/files/{fileId}/status', //查询文件状态
        'templatesStatus' => '/v1/docTemplates/{templateId}', //查询文件状态
        'templatesComponents' => '/v1/docTemplates/{templateId}/components', //查询文件状态

    ];
}
