<?php

namespace ESign\District;

use ESign\Response\File\FileStatus;
use ESign\Response\User\CreateByThirdPartyUserId;
use ESign\UrlSet;

class UserAccount extends District
{
    /**
     * 创建个人签署账号
     * @throws \Exception
     */
    public function createAccount(string $thirdPartyUserId, string $name, string $idNumber, $mobile = '', $idType = 'CRED_PSN_CH_IDCARD', $email = ''): UserAccount
    {
        $url = UrlSet::$set['createAccount'];

        $this->setUrl($url);

        $this->setMethod(self::$POST);

        $this->setResponse(CreateByThirdPartyUserId::class);

        if (!in_array($idType, [
            'CRED_PSN_CH_IDCARD',
            'CRED_PSN_CH_TWCARD',
            'CRED_PSN_CH_MACAO',
            'CRED_PSN_CH_HONGKONG',
            'CRED_PSN_PASSPORT',
        ])) {
            throw new \Exception($idType . ' is not allowed parameters');
        }

        $this->setParameter([
            'thirdPartyUserId' => $thirdPartyUserId,
            'name' => $name,
            'idType' => $idType,
            'idNumber' => $idNumber,
            'mobile' => $mobile,
            'email' => $email
        ]);

        return $this;
    }

    public function getByThirdId(string $thirdPartyUserId):self
    {

        $url = UrlSet::$set['getByThirdId'];

        $this->setUrl($url);

        $this->setMethod(self::$GET);

        $this->setResponse(CreateByThirdPartyUserId::class);

        $this->setParameter([
            'thirdPartyUserId' => $thirdPartyUserId,
        ]);

        return $this;
    }
}
