<?php

namespace ESign;

class UrlSet
{
    public static $set = [
        //文件
        'createTemplateByFile' => '/v1/docTemplates/createByUploadUrl', //通过上传方式创建模板
        'fileStatus' => '/v1/files/{fileId}', //查询文件状态
        'templatesStatus' => '/v1/docTemplates/{templateId}', //查询文件状态
        'templatesComponents' => '/v1/docTemplates/{templateId}/components', //查询文件状态
        'templateToFiles' => '/v1/files/createByTemplate', //通过模板创建文件
        //个人
        'createAccount' => '/v1/accounts/createByThirdPartyUserId', //创建个人签署账号
        'getByThirdId' => '/v1/accounts/getByThirdId', //查询个人签署账号


        //机构
        'createOrganizations' => '/v1/organizations/createByThirdPartyUserId', //创建机构签署账号
        'organizationsByOrgId' => '/v1/organizations/{orgId}', //查询机构签署账号
        'createOrgSeals' => '/v1/organizations/{orgId}/seals/officialtemplate', //创建机构模板印章
        'orgSeals' => '/v1/organizations/{orgId}/seals',//查询授权印章列表

        //授权
        'signAuth' => '/v1/signAuth/{accountId}',//设置静默签署授权

        //一步签署
        'flowOneStep' => '/api/v2/signflows/createFlowOneStep',

        //流程签署人
        'executeUrl' => '/v1/signflows/{flowId}/executeUrl', //获取签署地址

        //企业认证
        'orgAuthThree' => '/v2/identity/auth/api/organization/threeFactors',//发起企业核身认证3要素检验
        'orgLegalRepSignAuth' => '/v2/identity/auth/api/organization/{flowId}/legalRepSignAuth',

        //流程文档下载
        'documents' => '/v1/signflows/{flowId}/documents',
    ];
}
