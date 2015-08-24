<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/

namespace Bennsel\WindowsAzureCurl\General;


use Bennsel\WindowsAzureCurl\Service\Settings\SettingsInterface;
use Curl\Curl;

class RestClient
{
    protected $url;
    protected $authorization;
    protected $settings;

    public function __construct($url, SettingsInterface $settings, $authorization = '')
    {
        $this->url = $url;
        $this->authorization = $authorization;
        $this->settings = $settings;
    }

    public function send($url, $method, array $parameters = [], array $postParameters = [], array $header = [])
    {
        $curl = new Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);

        //$curl->setHeader('Content-Type', 'application/x-www-form-urlencoded');


        $method = strtolower($method);
        $url = strpos($url, '//') !== false ? $url : $this->url . $url;

        if(!empty($this->authorization) && empty($header['Authorization'])) {
            $authClass = 'Bennsel\\WindowsAzureCurl\\Service\\Authorization\\'.$this->authorization;
            $class = new $authClass($this->settings);
            $header['Authorization'] = $class->getAuthorizationString($url, $method, $parameters, $header);
        }

        foreach($header as $key => $value) {
            $curl->setHeader($key, $value);
        }

        $r = $curl->$method($url, $parameters ?: $postParameters);
        return $r;
    }
}