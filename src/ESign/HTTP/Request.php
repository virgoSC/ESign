<?php

namespace ESign\Http;

use ESign\Config;
use ESign\District\Common;
use ESign\District\District;
use ESign\Response\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Request
{

    public $header;

    /**
     * @var Config $config
     */
    private $config;

    /**
     * @var District $district
     */
    private $district;

    public function request(Config $config, District $district)
    {
        $this->config = $config;
        $this->district = $district;

        $this->buildHeader();

        $res = $this->district->getResponse();

        try {
            $client = new Client([
                'verify' => false,
                'http_errors' => false
            ]);

            $url = $district->getUrl();
            $param = $district->getParameter();


            switch ($district->getMethod()) {
                case 'PUT':
                    $response = $client->put($url, [
                        'headers' => $this->header,
                        'body' => $this->district->getParameter()[0]
                    ]);
                    break;
                case 'POST':
                    $response = $client->post($url, [
                        'headers' => $this->header,
                        'body' => json_encode($param, JSON_UNESCAPED_SLASHES),
                    ]);
                    break;
                default://get
                    if ($param) {
                        $url .= '?'.http_build_query($param);
                    }
                    $response = $client->get($url,[
                        'headers' => $this->header
                    ]);
                    break;
            }
            return (new $res())
                ->setCode($response->getStatusCode())
                ->setBody($response->getBody()->getContents())
                ->setHeader($response->getHeaders())->resolve();
        } catch (GuzzleException $e) {
            return (new $res())
                ->setCode('500')
                ->setError($e->getMessage());
        }

    }

    /**
     * 生成header
     */
    public function buildHeader()
    {
        if ($this->district->getHeader()) {
            $this->header = $this->district->getHeader();
            return;
        }
        $this->header = [
            'X-Tsign-Open-App-Id' => $this->config->getAppId(),
            'Content-Type' => 'application/json; charset=UTF-8',
            'X-Tsign-Open-Ca-Timestamp' => self::getMillisecond(),
            'Accept' => '*/*',
            'X-Tsign-Open-Auth-Mode' => 'Signature'
        ];

        if ($this->district->getMethod() !== District::$FORM) {
            $this->header['Content-MD5'] = Common::base64Md5($this->district->getParameter());
        }

        $this->header['X-Tsign-Open-Ca-Signature'] = $this->getSignature($this->header['Content-MD5'] ?? '');
    }

    private function getSignature($contentMd5 = ''): string
    {
        $signArray = [
            //HTTPMethod
            $this->district->getMethod(),
            //Accept
            "*/*",
        ];
        //Content-MD5
        $signArray[] = $contentMd5;

        //Content-Type
        $signArray[] = 'application/json; charset=UTF-8';
        //Date
        $signArray[] = "";
        //Url
        $signArray[] = $this->district->getRoute();

        $stringToSign = implode("\n", $signArray);

//        var_dump($stringToSign);exit;

//        $stringToSign = $this->district->getMethod() . "\n" . '*/*' . "\n" . $contentMd5 . "\n" . 'application/json; charset=UTF-8' . "\n" . '' . "\n";
//        $stringToSign .= $this->district->getUrl();

        $signature = hash_hmac("sha256", utf8_encode($stringToSign), utf8_encode($this->config->getSecret()), true);

        return base64_encode($signature);
    }

    /**
     * 毫秒
     * @return string
     */
    public static function getMillisecond(): string
    {
        list($s1, $s2) = explode(' ', microtime());
        return sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
    }
}
