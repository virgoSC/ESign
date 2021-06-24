<?php

namespace ESign\Http;

use ESign\Config;
use ESign\District\Common;
use ESign\District\District;
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

        $this->header();

        try {
            $client = new Client([
                'verify' => false,
                'http_errors' => false
            ]);

            $url = $district->getUrl();
            $param = $district->getParameter();

            switch ($district->getMethod()) {
                case 'POST':
                    $response = $client->post($url, [
                        'headers' => $this->header,
                        'body' => json_encode($param,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                    ]);
                    break;
                default://get
                    $url .= http_build_query($param);
                    $response = $client->get($url);
                    break;
            }

            return (new Response())
                ->setCode($response->getStatusCode())
                ->setBody($response->getBody()->getContents())
                ->setHeader($response->getHeaders())->resolve();
        } catch (GuzzleException $e) {
            return (new Response())
                ->setCode('500')
                ->setError($e->getMessage());
        }

    }

    /**
     * 生成header
     */
    public function header()
    {
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

//        var_dump($stringToSign);

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