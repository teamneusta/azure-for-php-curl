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
use Bennsel\WindowsAzureCurl\Service\Settings\SettingsInterface;
use Curl\Curl;

class BlobService implements ServiceInterface
{
    protected $storageUrl;

    /**
     * settings
     *
     * @var SettingsInterface
     */
    protected $settings;
    protected $defaultHeader = [];

    public function __construct(SettingsInterface $settings)
    {
        $this->settings = $settings;
        $this->storageUrl = 'https://' . $this->settings->getName() . '.blob.core.windows.net';
        $this->restClient = new RestClient($this->storageUrl, $settings, 'BlobAuthorization');
        $date = gmdate("D, d M Y H:i:s") . ' GMT';
        $this->defaultHeader['x-ms-date'] = $date;
        $this->defaultHeader['x-ms-version'] = '2015-02-21';
    }

    public function listContainers()
    {
        return $this->restClient->send('/', 'GET', ['comp' => 'list'], [], $this->defaultHeader);
    }

    public function listBlobs($container)
    {
        /** @var \SimpleXMLElement $r */
        $r = $this->restClient->send('/'.$container, 'GET', ['comp' => 'list', 'restype' => 'container', 'prefix' => 'werder/'], [], $this->defaultHeader);
        $json = json_encode($r);
        $array = json_decode($json,TRUE);
        return $array;
    }

    public function copyBlob(
        $destinationContainer,
        $destinationBlob,
        $sourceContainer,
        $sourceBlob,
        $options = null
    ) {
        $header = [];

        $encodedBlob = urlencode($sourceBlob);
        // Unencode the forward slashes to match what the server expects.
        $encodedBlob = str_replace('%2F', '/', $encodedBlob);
        // Unencode the backward slashes to match what the server expects.
        $encodedBlob = str_replace('%5C', '/', $encodedBlob);
        // Re-encode the spaces (encoded as space) to the % encoding.
        $encodedBlob = str_replace('+', '%20', $encodedBlob);

        $header['x-ms-copy-source'] = $this->storageUrl . '/' . $sourceContainer . '/' . $encodedBlob;
        $header['Content-Type'] = 'application/x-www-form-urlencoded';

        $encodedBlob = urlencode($destinationBlob);
        // Unencode the forward slashes to match what the server expects.
        $encodedBlob = str_replace('%2F', '/', $encodedBlob);
        // Unencode the backward slashes to match what the server expects.
        $encodedBlob = str_replace('%5C', '/', $encodedBlob);
        // Re-encode the spaces (encoded as space) to the % encoding.
        $encodedBlob = str_replace('+', '%20', $encodedBlob);
        $r = $this->restClient->send('/'.$destinationContainer.'/'.$encodedBlob, 'put', [], [], $this->defaultHeader + $header);
        $json = json_encode($r);
        $array = json_decode($json,TRUE);
        return $array;
    }
}