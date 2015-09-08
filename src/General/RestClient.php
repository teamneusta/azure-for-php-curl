<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/

namespace Bennsel\WindowsAzureCurl\General;


use Bennsel\WindowsAzureCurl\Model\General\ResponseModelMapping;
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

    public function send(
        $url,
        $method,
        array $parameters = [],
        array $postParameters = [],
        array $header = [],
        $content = ''
    )
    {
        $curl = new Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);

        $method = strtolower($method);
        $finalUrl = strpos($url, '//') !== false ? $url : $this->url . $url;

        if(!empty($this->authorization) && empty($header['Authorization'])) {
            $authClass = 'Bennsel\\WindowsAzureCurl\\Service\\Authorization\\'.$this->authorization;
            $class = new $authClass($this->settings);
            $header['Authorization'] = $class->getAuthorizationString($url, $method, $parameters, $header);
        }

        if ($content && is_object($content) && method_exists($content, 'toArray')) {
            $parameters = $content->toArray();
        }

        foreach($header as $key => $value) {
            $curl->setHeader($key, $value);
        }

        $orgHeader = $header;
        $r = $curl->$method($finalUrl, $parameters ?: $postParameters);

        if($curl->http_status_code == 301) {
            $this->url = $curl->response_headers['Location'];
            return $this->send($url, $method, $parameters, $postParameters, $orgHeader, $content);
        }

        return ResponseModelMapping::create($url, $r);
    }
}