<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/

namespace TeamNeusta\WindowsAzureCurl\General;


use TeamNeusta\WindowsAzureCurl\Model\General\ResponseModelMapping;
use TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsInterface;
use TeamNeusta\WindowsAzureCurl\General\RestClient\CurlClient;

class RestClient
{

    /**
     * restClient
     *
     * @var CurlClient
     */
    protected $restClient;

    public function __construct($url, SettingsInterface $settings, $authorization = '', $curlObject = null)
    {
        $class = '\\TeamNeusta\\WindowsAzureCurl\\General\\RestClient\\'.$settings->getHttpClient();
        if(class_exists($class)) {
            $this->restClient = new $class($url, $settings, $authorization, $curlObject);
        } else {
            throw new \Exception('HttpClient '.$class.' Class not Found');
        }
    }

    public function send(
        $url,
        $method,
        array $parameters = [],
        array $postParameters = [],
        array $header = [],
        $content = ''
    )
    {
        return $this->restClient->send($url, $method, $parameters, $postParameters, $header, $content);
    }
}