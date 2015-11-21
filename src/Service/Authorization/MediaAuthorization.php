<?php
namespace TeamNeusta\WindowsAzureCurl\Service\Authorization;

use TeamNeusta\WindowsAzureCurl\General\Constants;
use TeamNeusta\WindowsAzureCurl\General\RestClient;
use TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsInterface;

/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/

class MediaAuthorization {

    /**
     * settings
     *
     * @var SettingsInterface
     */
    protected $settings;

    /**
     * restClient
     *
     * @var RestClient
     */
    protected $restClient;

    public function __construct(SettingsInterface $settings) {
        $this->settings = $settings;
        $this->restClient = new RestClient(
            Constants::MEDIA_SERVICES_OAUTH_URL,
            $settings
        );

        $date = gmdate("D, d M Y H:i:s") . ' GMT';
        $this->canonicalizedHeaders['x-ms-date'] = $date;
    }

    /**
     * getCanonicalized
     *
     * @param string $url
     * @param array $queryParams
     * @param string $method
     * @return string
     */
    public function getAuthorizationString($url, $method, array $queryParams, array $header = []) {
        $result = $this->restClient->send('', 'post', [], [
                Constants::OAUTH_GRANT_TYPE => Constants::OAUTH_GT_CLIENT_CREDENTIALS,
                Constants::OAUTH_CLIENT_ID => $this->settings->getName(),
                Constants::OAUTH_CLIENT_SECRET => $this->settings->getKey(),
                Constants::OAUTH_SCOPE => Constants::MEDIA_SERVICES_OAUTH_SCOPE
            ],
            [
                'Content-Type', 'application/x-www-form-urlencoded'
            ]
        );

        return 'Bearer ' . $result->access_token;
    }

}