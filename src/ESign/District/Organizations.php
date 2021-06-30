<?php

namespace ESign\District;

use ESign\Response\DefaultResponse;
use ESign\Response\Organizations\AccountByThirdId;
use ESign\Response\Organizations\CreateSeal;
use ESign\Response\Organizations\OrganizationsByOrgId;
use ESign\Response\Organizations\Seals;
use ESign\UrlSet;

class Organizations extends District
{
    /**
     * 创建机构签署账号
     * @param string $thirdPartyUserId
     * @param string $creator
     * @param string $name
     * @param string $idNumber
     * @param string $idType
     * @param string|null $orgLegalIdNumber
     * @param string|null $orgLegalName
     * @return $this
     * @throws \Exception
     */
    public function createOrganization(string $thirdPartyUserId, string $creator, string $name, string $idNumber, string $idType = 'CRED_ORG_USCC', string $orgLegalIdNumber = null, string $orgLegalName = null): self
    {
        $url = UrlSet::$set['createOrganizations'];

        $this->setUrl($url);

        $this->setMethod(self::$POST);

        $this->setResponse(AccountByThirdId::class);

        if (!in_array($idType, [
            'CRED_ORG_USCC',
            'CRED_ORG_USCC',
            'CRED_ORG_REGCODE',
        ])) {
            throw new \Exception($idType . ' is not allowed parameters');
        }

        $this->setParameter([
            'thirdPartyUserId' => $thirdPartyUserId,
            'creator' => $creator,
            'name' => $name,
            'idType' => $idType,
            'idNumber' => $idNumber,
            'orgLegalIdNumber' => $orgLegalIdNumber,
            'orgLegalName' => $orgLegalName
        ]);

        return $this;
    }

    /**
     * 查询机构签署账号（通过orgId查询）
     * @param string $orgId
     * @return $this
     */
    public function organizationsByOrgId(string $orgId): self
    {
        $url = UrlSet::$set['organizationsByOrgId'];

        $url = str_replace('{orgId}', $orgId, $url);

        $this->setUrl($url);

        $this->setMethod(self::$GET);

        $this->setResponse(OrganizationsByOrgId::class);

        $this->setParameter([
            'orgId' => $orgId,
        ]);

        return $this;
    }

    /**
     * 创建机构模板印章
     * @param string $orgId
     * @param array|string[] $option
     * @return $this
     */
    public function createOrgSeals(string $orgId, array $option = ['color' => 'RED', 'type' => 'TEMPLATE_ROUND', 'central' => 'STAR']): self
    {
        $url = UrlSet::$set['createOrgSeals'];

        $url = str_replace('{orgId}', $orgId, $url);

        $this->setUrl($url);

        $this->setMethod(self::$POST);

        $this->setResponse(CreateSeal::class);

        $this->setParameter([
                'orgId' => $orgId,
            ] + $option);

        return $this;
    }


    public function signAuthOrg(string $accountId, string $deadline = '2099-01-01 00:00:00'): Organizations
    {
        $url = UrlSet::$set['signAuth'];

        $url = str_replace('{accountId}', $accountId, $url);

        $this->setUrl($url);

        $this->setMethod(self::$POST);

        $this->setResponse(DefaultResponse::class);

        $this->setParameter([
            'deadline' => $deadline
        ]);

        return $this;
    }

    /**
     * 查询授权印章列表
     * @param string $orgId
     * @param bool $downloadFlag
     * @param int $offset
     * @param int $size
     * @return $this
     */
    public function seals(string $orgId, bool $downloadFlag = true, int $offset = 1, int $size = 10): self
    {
        $url = UrlSet::$set['orgSeals'];

        $url = str_replace('{orgId}', $orgId, $url);

        $this->setUrl($url);

        $this->setMethod(self::$GET);

        $this->setResponse(Seals::class);

        $this->setParameter([
            'orgId' => $orgId,
            'downloadFlag' => $downloadFlag,
            'offset' => $offset,
            'size' => $size,
        ]);

        return $this;
    }
}
