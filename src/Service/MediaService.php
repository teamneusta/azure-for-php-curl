<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

namespace Bennsel\WindowsAzureCurl\Service;


use Bennsel\WindowsAzureCurl\General\Constants;
use Bennsel\WindowsAzureCurl\General\OAuthRestProxy;
use Bennsel\WindowsAzureCurl\General\RestClient;
use Bennsel\WindowsAzureCurl\Model\Media\Asset;
use Bennsel\WindowsAzureCurl\Service\Settings\SettingsInterface;

class MediaService implements ServiceInterface
{

    /**
     * settings
     *
     * @var SettingsInterface
     */
    protected $settings;

    /**
     * accessToken
     *
     * @var string
     */
    protected $accessToken;

    /**
     * restClient
     *
     * @var RestClient
     */
    protected $restClient;

    protected $defaultHeader = [];

    public function __construct(SettingsInterface $settings)
    {
        $this->settings = $settings;
        $this->restClient = new RestClient(Constants::MEDIA_SERVICES_URL, $this->settings, 'MediaAuthorization');
        $this->defaultHeader['x-ms-version'] = '2.11';
        $this->defaultHeader['Content-Type'] = 'application/json;odata=verbose';
        $this->defaultHeader['Accept'] = 'application/json;odata=verbose';
    }

    public function getAssetList()
    {
        $skipping = 0;
        $newArr = [];
        $finish = false;
        while (!$finish) {
            $result = $this->restClient->send('Assets', 'get', ['$skip' => $skipping], [], $this->defaultHeader);
            $skipping = $skipping + 1000;
            if (empty($result)) {
                $finish = true;
            } else {
                $newArr = array_merge($newArr, $result);
            }
        }

        return $newArr;
    }

    public function getAssetByName($name)
    {
        $obj = $this->restClient->send('Assets', 'get', [
            '$filter' => 'Name eq \'' . $name . '\''
        ], [], $this->defaultHeader);
        return $obj;
    }

    public function deleteAsset($assetId)
    {
        $obj = $this->restClient->send('Assets(\'' . $assetId . '\')', 'delete', [], [], $this->defaultHeader);
        return $obj;
    }

    public function createAsset(Asset $asset)
    {
        $newAsset = $this->restClient->send('Assets', 'post', [], [], $this->defaultHeader, $asset);

        $r = $this->restClient->send('AccessPolicies', 'post', [], [
            'Name' => 'foo',
            'DurationInMinutes' => 1000,
            'Permissions' => '1'
        ], $this->defaultHeader);

        $now = new \DateTime();
        $r = $this->restClient->send('Locators', 'post', [], [
            'AccessPolicyId' => $r->d->Id,
            'AssetId' => $newAsset->getId(),
            'StartTime' => $now->format('Y-m-d\TH:i:sP'),
            'Type' => '2'
        ], $this->defaultHeader);

        return $newAsset;
    }

    public function createFileInfos(Asset $asset)
    {
        return $this->restClient->send('CreateFileInfos?assetid=' . '\'' . urlencode($asset->getId()) . '\'', 'get', [], [], $this->defaultHeader);
    }

    public function getLatestMediaProcessor($name)
    {
        $mediaProcessors = $this->restClient->send('MediaProcessors', 'get', [], [], $this->defaultHeader);
        foreach ($mediaProcessors->d->results as $mediaProcessor) {
            if (strtolower($mediaProcessor->Name) === strtolower($name)) {
                return $mediaProcessor;
            }
        }
    }

    public function getJobList()
    {
        $skipping = 0;
        $newArr = [];
        $finish = false;
        while (!$finish) {
            $obj = $this->restClient->send('Jobs', 'get', ['$skip' => $skipping], [], $this->defaultHeader);
            $skipping = $skipping + 1000;
            if (empty($obj->d->results)) {
                $finish = true;
            } else {
                $newArr = array_merge($newArr, $obj->d->results);
            }
        }

        return $newArr;
    }
}