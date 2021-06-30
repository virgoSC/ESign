<?php

namespace ESign\District;

use ESign\Response\SignFlows\Documents;
use ESign\UrlSet;
use ESign\Response\SignFlows\ExecuteUrl;

class SignFlows extends District
{
    /**
     * 获取签署地址
     * @param string $flowId
     * @param string $accountId
     * @param string|null $organizeId
     * @param int $urlType
     * @param string $appScheme
     * @return $this
     */
    public function executeUrl(string $flowId,string $accountId,string $organizeId = null ,int $urlType = 0, string $appScheme = ''): SignFlows
    {
        $url = UrlSet::$set['executeUrl'];

        $url = str_replace('{flowId}', $flowId, $url);

        $this->setUrl($url);

        $this->setMethod(self::$GET);

        $this->setResponse(ExecuteUrl::class);


        $param = [
            'flowId' => $flowId,
            'accountId' => $accountId,
        ];

        if ($organizeId) {
            $param['organizeId'] = $organizeId;
        }

        if ($urlType) {
            $param['urlType'] = $urlType;
        }
        if ($appScheme) {
            $param['appScheme'] = $appScheme;
        }

        $this->setParameter($param);

        return $this;
    }


    public function documents(string $flowId): SignFlows
    {
        $url = UrlSet::$set['documents'];

        $url = str_replace('{flowId}', $flowId, $url);

        $this->setUrl($url);

        $this->setMethod(self::$GET);

        $this->setResponse(Documents::class);

        $this->setParameter([]);

        return $this;
    }
}
