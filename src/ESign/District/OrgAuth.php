<?php

namespace ESign\District;

use ESign\Response\DefaultResponse;
use ESign\UrlSet;
use ESign\Response\SignFlows\FlowOneStep;

/**
 * 企业认证
 * Class OrgAuth
 * @package ESign\District
 */
class OrgAuth extends District
{
    /**
     * 发起企业核身认证3要素检验
     * @param string $name
     * @param string $orgCode
     * @param string $legalRepName
     * @param string|null $contextId
     * @param string|null $notifyUrl
     * @return $this
     */
    public function orgAuthThree(string $name, string $orgCode, string $legalRepName, string $contextId = null, string $notifyUrl = null): self
    {
        $url = UrlSet::$set['orgAuthThree'];

        $this->setUrl($url);

        $this->setMethod(self::$POST);

        $this->setResponse(FlowOneStep::class);

        $this->setParameter( [
            'name' => $name,
            'orgCode' => $orgCode,
            'legalRepName' => $legalRepName,
            'contextId' => $contextId,
            'notifyUrl' => $notifyUrl
        ]);

        return $this;
    }


    /**
     * 发起授权签署实名认证
     * @param string $flowId
     * @param string $mobileNo
     * @param string|null $legalRepIdNo
     * @param string|null $redirectUrl
     * @return $this
     */
    public function orgLegalRepSignAuth(string $flowId, string $mobileNo, string $legalRepIdNo = '', string $redirectUrl = ''): self
    {
        $url = UrlSet::$set['orgLegalRepSignAuth'];

        $url = str_replace('{flowId}', $flowId, $url);

        $this->setUrl($url);

        $this->setMethod(self::$POST);

        $this->setResponse(DefaultResponse::class);

        $this->setParameter([
            'mobileNo' => $mobileNo,
            'legalRepIdNo' => $legalRepIdNo,
            'redirectUrl' => $redirectUrl
        ]);

        return $this;
    }
}
