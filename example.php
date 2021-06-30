<?php

use ESign\Response\User\CreateByThirdPartyUserId;

require_once('vendor/autoload.php');

$esign = new \ESign\ESign([
    'appid' => 'appid',
    'secret' => 'secret',
    'host' => 'https://smlopenapi.esign.cn'
]);

//通过上传方式创建模板
if (0) {
    $response = $esign->createByFile('E:/wolf/ESign/doc/test.pdf');
    var_dump($response->isSuccess());
    var_dump($response->getError());
    var_dump($response->getTemplateId());
    $url = $response->getUploadUrl();
    $templateId = $response->getTemplateId();
}

//文件流上传
if (0) {
    //文件上传地址
    $url = 'http://esignoss.esign.cn/*************';
    //模板Id
    $templateId = 'e6c32254d4084d***********';

    $response = $esign->fileUpload('E:/wolf/ESign/doc/test.pdf', $url);
    var_dump($response->isSuccess(), $response->getError(), $response->getBody());
}


//查询模板详情/下载模板
if (0) {
    $response = $esign->docTemplates($templateId);
    var_dump($response->isSuccess(), $response->getError(), $response->getBody());
    var_dump($response->getDownloadUrl(), $response->getStructComponents());
}

//添加输入项组件
if (0) {
    $structComponent = new \ESign\District\StructComponent();
//
    $structComponent->setStructId('67db749bee6d4503a31b4cacd58c3941')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('year')->setHeight(12)->setWidth(50)->setFontSize(10.5)->setPage(1)->setX(324)->setY(722)->append();
    $structComponent->setStructId('42f691f804f342459c9166ac043997e8')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('contractNum')->setHeight(12)->setWidth(50)->setFontSize(10.5)->setPage(1)->setX(420)->setY(722)->append();
    $structComponent->setStructId('58dca29e844c46a99f00556262842862')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('borrower')->setHeight(12)->setWidth(200)->setFontSize(10.5)->setPage(1)->setX(170)->setY(560)->append();
    $structComponent->setStructId('b538121a815b4a17a7cf0b3335b76b7e')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('borrowerID')->setHeight(12)->setWidth(200)->setFontSize(10.5)->setPage(1)->setX(140)->setY(535)->append();
    $structComponent->setStructId('81ab8a50cd3a499495746c6d281ae63a')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('borrowerAddress')->setHeight(12)->setWidth(200)->setFontSize(10.5)->setPage(1)->setX(145)->setY(510)->append();
    $structComponent->setStructId('a6556c17d1334632a9923547159493b6')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('borrowerPhone')->setHeight(12)->setWidth(200)->setFontSize(10.5)->setPage(1)->setX(142)->setY(484)->append();

    $structComponent->setStructId('347a19a601f344d4a6dc4e18b6247739')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('money')->setHeight(12)->setWidth(100)->setFontSize(10.5)->setPage(2)->setX(194)->setY(750)->append();
    $structComponent->setStructId('48f203ee86c3421fbb2f8a4f945d69ae')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('moneyUp')->setHeight(12)->setWidth(200)->setFontSize(10.5)->setPage(2)->setX(301)->setY(750)->append();
    $structComponent->setStructId('c587c346ecef4c6c9174f4b216fdfc08')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('month')->setHeight(12)->setWidth(30)->setFontSize(10.5)->setPage(2)->setX(178)->setY(730)->append();
    $structComponent->setStructId('df904988b11244dda55696aef9b38d30')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('beginAt')->setHeight(12)->setWidth(50)->setFontSize(10.5)->setPage(2)->setX(255)->setY(730)->append();
    $structComponent->setStructId('ddea3a65a4d34e03a01d0e7d337c08d7')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('endAt')->setHeight(12)->setWidth(50)->setFontSize(10.5)->setPage(2)->setX(320)->setY(730)->append();
    $structComponent->setStructId('43f63c5ab20643d9b2cf9f8a6470cdcf')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('owner')->setHeight(12)->setWidth(100)->setFontSize(10.5)->setPage(2)->setX(180)->setY(645)->append();
    $structComponent->setStructId('3e9e64ca38c64a89a63c4546c3dc6f3a')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('licenseNo')->setHeight(12)->setWidth(100)->setFontSize(10.5)->setPage(2)->setX(324)->setY(645)->append();
    $structComponent->setStructId('f8a1d48d468740e38a5bc3ef24e9a933')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('InsuranceNo')->setHeight(12)->setWidth(300)->setFontSize(10.5)->setPage(2)->setX(168)->setY(622)->append();

    $structComponent->setStructId('41cdb4d051824838b4be49d8b4616d84')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('bankOwner')->setHeight(12)->setWidth(300)->setFontSize(10.5)->setPage(2)->setX(163)->setY(538)->append();
    $structComponent->setStructId('37ab4b43b4734def961ba965fe2b1902')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('bankName')->setHeight(12)->setWidth(300)->setFontSize(10.5)->setPage(2)->setX(163)->setY(520)->append();
    $structComponent->setStructId('1f761be7ee9c400ba7b88865bae35b40')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('bankNum')->setHeight(12)->setWidth(300)->setFontSize(10.5)->setPage(2)->setX(163)->setY(500)->append();

    $structComponent->setStructId('8d9978a719a84d5aa25582df44f6a051')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('repayDay')->setHeight(12)->setWidth(300)->setFontSize(10.5)->setPage(2)->setX(410)->setY(428)->append();

    $structComponent->setStructId('2cb835e967534388969418590ecb6841')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('date')->setHeight(12)->setWidth(30)->setFontSize(10.5)->setPage(5)->setX(160)->setY(474)->append();
    $structComponent->setStructId('b227a130ad6b40b3a397839bbf46eb53')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('date1')->setHeight(12)->setWidth(20)->setFontSize(10.5)->setPage(5)->setX(191)->setY(474)->append();
    $structComponent->setStructId('1b0d6cbf63344a9497272e70951f69dd')->setType(\ESign\District\StructComponent::TYPE_TEXT)->setLabel('date2')->setHeight(12)->setWidth(20)->setFontSize(10.5)->setPage(5)->setX(211)->setY(474)->append();
//
    $response = $esign->templates($templateId, $structComponent);

    var_dump($response->isSuccess(), $response->getBody(), $response->getError());
}

//通过模板创建文件
if (0) {
    $response = $esign->templateToFiles($templateId, 'testName1', [
        '67db749bee6d4503a31b4cacd58c3941' => date('Y'),
        '42f691f804f342459c9166ac043997e8' => '058' . '000001',
        '58dca29e844c46a99f00556262842862' => "测试人",
        'b538121a815b4a17a7cf0b3335b76b7e' => '510125126365956230',
        '81ab8a50cd3a499495746c6d281ae63a' => '四川省高新区',
        'a6556c17d1334632a9923547159493b6' => '18562365985',

        '347a19a601f344d4a6dc4e18b6247739' => '2630.22',
        '48f203ee86c3421fbb2f8a4f945d69ae' => '叁仟陆佰叁拾点贰贰',
        'c587c346ecef4c6c9174f4b216fdfc08' => '12',
        'df904988b11244dda55696aef9b38d30' => '2021-6-15',
        'ddea3a65a4d34e03a01d0e7d337c08d7' => '2022-5-25',
        '43f63c5ab20643d9b2cf9f8a6470cdcf' => '测试人',
        '3e9e64ca38c64a89a63c4546c3dc6f3a' => '川A12345',
        'f8a1d48d468740e38a5bc3ef24e9a933' => 'AaBbCc123456789',

        '41cdb4d051824838b4be49d8b4616d84' => '测试人',
        '37ab4b43b4734def961ba965fe2b1902' => '天府银行',
        '1f761be7ee9c400ba7b88865bae35b40' => 'TT112233445566',
        '8d9978a719a84d5aa25582df44f6a051' => '25',

        '2cb835e967534388969418590ecb6841' => date('Y'),
        'b227a130ad6b40b3a397839bbf46eb53' => date('m'),
        '1b0d6cbf63344a9497272e70951f69dd' => date('d'),


    ]);

    var_dump($response->isSuccess(), $response->getError(), $response->getBody());
    var_dump($response->getDownloadUrl(), $response->getFileId(), $response->getFileName());
}

$fileId = '8972c64b91********************';
//文件状态
if (0) {
    $response = $esign->fileStatus($fileId);
    var_dump($response->isSuccess(), $response->getError(), $response->getBody());
}

//创建个人账户
if (0) {
    $response = $esign->createAccount('510130197207017359', 'test1', '510130197207017359', 18215626530);

    var_dump($response->isSuccess(), $response->getError(), $response->getCode(), $response->getAccountId());
}

//查询个人签署账号
if (0) {
    $response = $esign->getByThirdId('510130197207017359');
    var_dump($response->getBody());
}

$accountId = '479adcb803e349********************';

//创建机构签署账号
if (0) {
    $response = $esign->createOrganization('9151011**********L', $accountId, '*******有限责任公司', '9****************L');

    var_dump($response->isSuccess(), $response->getError(), $response->getOrgId());

    $response = $esign->createOrganization('9151010**********', $accountId, '*********有限公司', '915*****************8');

    var_dump($response->isSuccess(), $response->getError(), $response->getOrgId());
}

$orgId = 'a6cab4de5*****************';

$orgId2 = 'a885201f*************';

//查询机构账户ByOrgId
if (0) {
    $response = $esign->organizationsByOrgId($orgId);
    var_dump($response->isSuccess(), $response->getError(), $response->getInfo());
}

//设置机构默认印章
if (0) {
    $response = $esign->createOrgSeals($orgId);

    var_dump($response->isSuccess(), $response->getError());
    var_dump($response->getBody());
    var_dump($response->getSealId());
}
//企业三要素
if (0) {
    $response = $esign->orgAuthThree('*******有限责任公司', '9**********L', 'test');
    var_dump($response->isSuccess(), $response->getError(), $response->getFlowId());
    $fid = '182222222222222239';
}

//发起授权签署实名认证
if (0) {
    $response = $esign->orgLegalRepSignAuth('182222222222222239', '15********82', '5****************9');
    var_dump($response->getBody());
}

//查询授权印章列表
if (0) {
    $response = $esign->seals($orgId);
    var_dump($response->isSuccess(), $response->getError(), $response->getBody(), $response->getSeals());
}
//设置静默签署授权
if (0) {
    $response = $esign->signAuthOrg($orgId);
    var_dump($response->isSuccess(), $response->getError(), $response->getBody());
}

$seals = '25*********************852';

$seals2 = '369*******************00ada';

//一键签署
if (1) {
    $flowOneStep = new \ESign\District\OneStepConfig();
    $flowOneStep->docs($fileId);
    $flowOneStep->flowInfo('一键签署', true, true);
    $flowOneStep->flowConfigInfo([
        'noticeType' => 1,
        'redirectUrl' => 'http://**************ccess',
        'signPlatform' => 1,
        'willTypes' => ['CODE_SMS'],
    ]);
    $flowOneStep->signers([
        [
            'autoExecute' => false,
            'fileId' => $fileId,
            'posBean' => [
                'posPage' => 5,
                'posX' => '201',
                'posY' => '629',
            ],
            'width' => '100'
        ],
    ], [
        'signerAccountId' => '479******************63'
    ], false, 1);

    $flowOneStep->signers(
        [
            [
                'autoExecute' => true,
                'actorIndentityType' => 2,
                'fileId' => $fileId,
                'sealId' => $seals,
                'posBean' => [
                    'posPage' => 5,
                    'posX' => '455',
                    'posY' => '603',
                ],
                'width' => '100'
            ],
        ], [],
        true);

    $flowOneStep->signers(
        [
            [
                'autoExecute' => true,
                'actorIndentityType' => 2,
                'fileId' => $fileId,
                'sealId' => $seals2,
                'posBean' => [
                    'posPage' => 5,
                    'posX' => '196',
                    'posY' => '532',
                ],
                'width' => '100'
            ],
        ], [],
        true);

    $response = $esign->createFlowOneStep($flowOneStep);
    var_dump($response->isSuccess(), $response->getError(), $response->getFlowId());
    $flowId = $response->getFlowId();
}
//获取签署地址
if (1) {
    if (!$flowId) {
        exit;
    }

    $response = $esign->executeUrl($flowId, '47****************63');
    var_dump($response->getUrl());
}

//流程文档下载
if (1) {
    $response = $esign->documents('aa8be**********************');
    var_dump($response->isSuccess(),$response->getError(),$response->getBody());
    var_dump($response->getFileUrl());
}

