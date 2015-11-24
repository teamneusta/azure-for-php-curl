<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\General\RestClient;

use GuzzleHttp\Client;
use TeamNeusta\WindowsAzureCurl\Model\General\ResponseModelMapping;
use TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsInterface;
use Curl\Curl;

class GuzzleClient {
    protected $url;
    protected $authorization;
    protected $settings;

    /**
     * curl
     *
     * @var Client
     */
    protected $guzzle;

    public function __construct($url, SettingsInterface $settings, $authorization = '', Client $guzzleObject = null)
    {
        $this->url = $url;
        $this->authorization = $authorization;
        $this->settings = $settings;
        $this->guzzle = $guzzleObject ?: new Client();
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
        $method = strtolower($method);
        $finalUrl = strpos($url, '//') !== false ? $url : $this->url . $url;

        if(!empty($this->authorization) && empty($header['Authorization'])) {
            $authClass = 'TeamNeusta\\WindowsAzureCurl\\Service\\Authorization\\'.$this->authorization;
            $class = new $authClass($this->settings);
            $header['Authorization'] = $class->getAuthorizationString($url, $method, $parameters, $header);
        }

        if ($content && is_object($content) && method_exists($content, 'toArray')) {
            $parameters = $content->toArray();
        }

        $orgHeader = $header;

        $r = $this->guzzle->createRequest($method, $finalUrl, array_merge(array_filter([
            'headers' => $header,
            'query' => $parameters,
            'body' => $postParameters,
            'json' => $content ? array_filter($content) : false
        ]), ['allow_redirects' => false]));
        $r = $this->guzzle->send($r);

        if($r->getStatusCode() == 301) {
            $location = $r->getHeader('Location');
            $this->url = is_array($location) ? current($location) : $location;
            return $this->send($url, $method, $parameters, $postParameters, $orgHeader, $content);
        }

        $content = $r->getBody()->getContents();
        $array = json_decode($content, true);
        if(json_last_error() !== JSON_ERROR_NONE) {
            $xml = simplexml_load_string($content);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
        }

        return ResponseModelMapping::create($url, $array);
    }
}