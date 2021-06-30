<?php

namespace ESign;

use ESign\District\Common;
use ESign\District\District;
use ESign\District\FlowOneStep;
use ESign\District\OneStepConfig;
use ESign\District\Organizations;
use ESign\District\OrgAuth;
use ESign\District\SignFlows;
use ESign\District\StructComponent;
use ESign\District\Template;
use ESign\District\UserAccount;
use ESign\Http\Request;
use ESign\Response\DefaultResponse;
use ESign\Response\File\Components;
use ESign\Response\File\CreateByUploadUrl;
use ESign\Response\File\DocTemplates;
use ESign\Response\File\FileUpload;
use ESign\Response\File\TemplateToFiles;
use ESign\Response\Organizations\OrganizationsByOrgId;
use ESign\Response\Organizations\Seals;
use ESign\Response\Response;
use ESign\Response\SignFlows\ExecuteUrl;
use ESign\Response\SignFlows\FlowOneStep as FlowOneStopResponse;
use ESign\Response\User\CreateByThirdPartyUserId;
use Exception;

/**
 * Class ESign
 * @method uploadUrl(string $dist)
 * 文件api
 * @method CreateByUploadUrl createByFile(string $fileDir)
 * @method FileUpload fileUpload(string $fileDir, string $url)
 * @method DocTemplates docTemplates(string $templateId)
 * @method Components templates(string $templateId, StructComponent $structComponent)
 * @method TemplateToFiles templateToFiles(string $templateId, string $name, array $formField)
 *
 *个人api
 * @method CreateByThirdPartyUserId createAccount($thirdPartyUserId, $name, $idNumber, $mobile = '', $idType = 'CRED_PSN_CH_IDCARD', $email = '')
 * @method \ESign\Response\User\AccountByThirdId getByThirdId(string $thirdPartyUserId)
 *
 * 机构api
 * @method \ESign\Response\Organizations\AccountByThirdId createOrganization(string $thirdPartyUserId, string $creator, string $name, string $idNumber, string $idType = 'CRED_ORG_USCC', string $orgLegalIdNumber = null, string $orgLegalName = null)
 * @method Seals seals(string $orgId, bool $downloadFlag = true, int $offset = 1, int $size = 10)
 * @method OrganizationsByOrgId organizationsByOrgId(string $orgId)
 * @method \ESign\Response\Organizations\createSeal createOrgSeals(string $orgId, array $option = ['color' => 'RED', 'type' => 'TEMPLATE_ROUND', 'central' => 'STAR'])
 *
 * @method DefaultResponse signAuthOrg(string $accountId, string $deadline = '2099-01-01 00:00:00')
 * 一步签署api
 * @method FlowOneStopResponse createFlowOneStep(OneStepConfig $oneStepConfig)
 *
 * @method ExecuteUrl executeUrl(string $flowId, string $accountId, string $organizeId = null, int $urlType = 0, string $appScheme = '')
 *
 * @method FileUpload fileStatus(string $fileId)
 *
 * 企业认证
 * @method FlowOneStopResponse orgAuthThree(string $name, string $orgCode, string $legalRepName, string $contextId = null, string $notifyUrl = null)
 * @method DefaultResponse orgLegalRepSignAuth(string $flowId, string $mobileNo, string $legalRepIdNo = null, string $redirectUrl = null)
 * @package ESign
 */
class ESign
{

    protected $config;

    /**
     * @var Common $common
     */

    protected $district = [];

    private $map = [];

    /**
     * @throws Exception
     */
    public function __construct($options)
    {
        $this->config = new Config($options['appid'] ?? '', $options['secret'] ?? '', $options['host'] ?? '');;
        $this->mapping();
    }


    /**
     * 设置方法映射
     * @throws Exception
     */
    protected function mapping()
    {
        $classes = [
            Template::class,
            UserAccount::class,
            FlowOneStep::class,
            SignFlows::class,
            Organizations::class,
            OrgAuth::class
        ];

        foreach ($classes as $class) {
            $methods = get_class_methods($class);
            $classMethods = array_combine($methods, array_fill(0, count($methods), $class));

            $intersect = array_intersect($this->map, $classMethods);
            if ($intersect) {
                throw new Exception("class $class has intersect " . array_keys($intersect)[0]);
            }
            $this->map = array_merge($this->map, $classMethods);
        }
    }

    /**
     * 方法->对象实例
     * @throws Exception
     */
    private function resolve($method)
    {
        if (!key_exists($method, $this->map)) {
            throw new Exception('method ' . $method . ' not found');
        }
        $class = $this->map[$method];

        if (!key_exists($class, $this->district)) {
            $this->district[$class] = new $class;
        }

        return $this->district[$class];
    }


    /**
     * 请求
     * @param District $district
     * @return Response
     */
    public function handle(District $district): Response
    {
        $district->setBaseUrl($this->config->getHost());

        return (new Request())->request($this->config, $district);
    }

    /**
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        $class = $this->resolve($name);
        $class->$name(...$arguments);
        return $this->handle($class);
    }
}
