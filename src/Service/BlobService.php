<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Service;


use TeamNeusta\WindowsAzureCurl\General\Constants;
use TeamNeusta\WindowsAzureCurl\General\OAuthRestProxy;
use TeamNeusta\WindowsAzureCurl\General\RestClient;
use TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsInterface;
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
        $sourceBlob
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