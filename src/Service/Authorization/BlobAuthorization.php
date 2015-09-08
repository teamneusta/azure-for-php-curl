<?php
namespace Bennsel\WindowsAzureCurl\Service\Authorization;

use Bennsel\WindowsAzureCurl\Service\Settings\SettingsInterface;

/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/

class BlobAuthorization {

    /**
     * settings
     *
     * @var SettingsInterface
     */
    protected $settings;

    public function __construct(SettingsInterface $settings) {
        $this->settings = $settings;

        $date = gmdate("D, d M Y H:i:s") . ' GMT';
        $this->canonicalizedHeaders['x-ms-copy-source'] = '';
        $this->canonicalizedHeaders['x-ms-date'] = $date;
        $this->canonicalizedHeaders['x-ms-version'] = $this->msVersion;
    }

    private $fixedHeaders = [
        'Content-Encoding' => '',
        'Content-Language' => '',
        'Content-Length' => '',
        'Content-MD5' => '',
        'Content-Type' => '',
        'date' => '',
        'If-Modified-Since' => '',
        'if-match' => '',
        'if-none-match' => '',
        'if-unmodified-since' => '',
        'range' => ''
    ];

    private $canonicalizedHeaders = [];

    private $msVersion = '2015-02-21';

    /**
     * getCanonicalized
     *
     * @param string $url
     * @param array $queryParams
     * @param string $method
     * @return string
     */
    public function getAuthorizationString($url, $method, array $queryParams, array $header = []) {
        $canonicalizedResource = '/' . $this->settings->getName() . parse_url($url, PHP_URL_PATH);

        if (count($queryParams) > 0) {
            ksort($queryParams);
        }
        foreach ($queryParams as $key => $value) {
            // Grouping query parameters
            $values = explode(',', $value);
            sort($values);
            $separated = implode(',', $values);

            $canonicalizedResource .= "\n" . $key . ':' . $separated;
        }

        $stringToSign = [];
        $stringToSign[] = strtoupper($method);
        foreach($this->fixedHeaders as $headerKey => $headerValue) {
            $stringToSign[] = !empty($header[$headerKey]) || is_numeric($header[$headerKey]) ? $header[$headerKey] : $headerValue;
        }

        if(!empty($header)) {
            foreach($this->canonicalizedHeaders as $headerKey => $headerValue) {
                if(!empty($header[$headerKey])) {
                    $this->canonicalizedHeaders[$headerKey] = $header[$headerKey];
                }
            }
        }

        $this->canonicalizedHeaders = array_filter($this->canonicalizedHeaders);
        if (count($this->canonicalizedHeaders) > 0) {
            $canonicalizedHeaders = [];
            foreach($this->canonicalizedHeaders as $headerKey => $headerValue) {
                $canonicalizedHeaders[] = $headerKey.':'.$headerValue;
            }
            $stringToSign[] = implode("\n", $canonicalizedHeaders);
        }
        $stringToSign[] = $canonicalizedResource;
        $signature   = implode("\n", $stringToSign);

        return 'SharedKey ' . $this->settings->getName() . ':' . base64_encode(
            hash_hmac('sha256', $signature, base64_decode($this->settings->getKey()), true)
        );
    }

}