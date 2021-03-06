<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/

namespace TeamNeusta\WindowsAzureCurl\Service;


use TeamNeusta\WindowsAzureCurl\General\Constants;
use TeamNeusta\WindowsAzureCurl\General\RestClient;
use TeamNeusta\WindowsAzureCurl\Model\Media\Asset;
use TeamNeusta\WindowsAzureCurl\Model\Media\Channel;
use TeamNeusta\WindowsAzureCurl\Model\Media\Job;
use TeamNeusta\WindowsAzureCurl\Model\Media\Program;
use TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsInterface;

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
        return $this->getAll('Assets', 'get', [], [], $this->defaultHeader);;
    }

    public function getAssetByName($name)
    {
        $obj = $this->restClient->send('Assets', 'get', [
            '$filter' => 'Name eq \'' . $name . '\''
        ], [], $this->defaultHeader);
        return $obj;
    }

    public function getAssetByFilter($filter)
    {
        $obj = $this->getAll('Assets', 'get', [
            '$filter' => $filter
        ], [], $this->defaultHeader);
        return $obj;
    }

    public function getFilesByFilter($filter)
    {
        $obj = $this->getAll('Files', 'get', [
            '$filter' => $filter
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
        $newAsset = $this->restClient->send('Assets', 'post', [], [], $this->defaultHeader, $asset->toArray());
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

    public function getJob($job)
    {
        $jobId = is_object($job) && method_exists($job, 'getId') ? $job->getId() : $job;
        return $this->restClient->send('Jobs(\'' . $jobId .'\')', 'get', [], [], $this->defaultHeader);
    }

    public function getJobList()
    {
        return $this->getAll('Jobs', 'get', [], [], $this->defaultHeader);
    }

    public function getJobOutputMediaAssets(Job $job)
    {
        return $this->restClient->send('Jobs(\'' . $job->getId() .'\')/OutputMediaAssets', 'get', [], [], $this->defaultHeader);
    }

    public function getJobListByState($state, $filter = null)
    {
        return $this->getJobListByFilter('State eq ' . $state . ($filter ? ' and ' . $filter : ''));
    }

    public function getJobListByFilter($filter)
    {
        return $this->getAll('Jobs', 'get', array_filter([
            '$filter' => $filter
        ]), [], $this->defaultHeader);
    }

    public function createChannel(Channel $channel)
    {
        $header = array_merge($this->defaultHeader, [
            'Content-Type' => 'application/json;odata=minimalmetadata',
            'Accept' => 'application/json;odata=minimalmetadata'
        ]);

        return $this->restClient->send('Channels', 'post', [], [], $header, $channel->toArray());
    }

    public function getChannel($channelId)
    {
        $header = array_merge($this->defaultHeader, [
            'Content-Type' => 'application/json;odata=minimalmetadata',
            'Accept' => 'application/json;odata=minimalmetadata'
        ]);

        return $this->restClient->send('Channels(\''.$channelId.'\')', 'get', [], [], $header, []);
    }

    public function startChannel(Channel $channel) {

        $header = array_merge($this->defaultHeader, [
            'Content-Type' => 'application/json;odata=minimalmetadata',
            'Accept' => 'application/json;odata=minimalmetadata'
        ]);

        return $this->restClient->send('Channels(\''.$channel->getId().'\')/Start', 'post', [], [], $header, []);
    }

    public function stopChannel(Channel $channel) {

        $header = array_merge($this->defaultHeader, [
            'Content-Type' => 'application/json;odata=minimalmetadata',
            'Accept' => 'application/json;odata=minimalmetadata'
        ]);

        return $this->restClient->send('Channels(\''.$channel->getId().'\')/Stop', 'post', [], [], $header, []);
    }

    public function resetChannel(Channel $channel) {

        $header = array_merge($this->defaultHeader, [
            'Content-Type' => 'application/json;odata=minimalmetadata',
            'Accept' => 'application/json;odata=minimalmetadata'
        ]);

        return $this->restClient->send('Channels(\''.$channel->getId().'\')/Reset', 'post', [], [], $header, []);
    }

    public function deleteChannel(Channel $channel) {

        $header = array_merge($this->defaultHeader, [
            'Content-Type' => 'application/json;odata=minimalmetadata',
            'Accept' => 'application/json;odata=minimalmetadata'
        ]);

        return $this->restClient->send('Channels(\''.$channel->getId().'\')', 'delete', [], [], $header, []);
    }

    public function listChannels()
    {
        return $this->restClient->send('Channels', 'get', [], [], $this->defaultHeader, '');
    }

    public function createProgram(Program $program)
    {
        $header = array_merge($this->defaultHeader, [
            'Content-Type' => 'application/json;odata=minimalmetadata',
            'Accept' => 'application/json;odata=minimalmetadata'
        ]);

        return $this->restClient->send('Programs', 'post', [], [], $header, $program->toArray());
    }

    public function startProgram(Program $program)
    {
        $header = array_merge($this->defaultHeader, [
            'Content-Type' => 'application/json;odata=minimalmetadata',
            'Accept' => 'application/json;odata=minimalmetadata'
        ]);

        return $this->restClient->send('Programs(\''.$program->getId().'\')/Start', 'post', [], [], $header);
    }

    public function stopProgram(Program $program)
    {
        $header = array_merge($this->defaultHeader, [
            'Content-Type' => 'application/json;odata=minimalmetadata',
            'Accept' => 'application/json;odata=minimalmetadata'
        ]);

        return $this->restClient->send('Programs(\''.$program->getId().'\')/Stop', 'post', [], [], $header);
    }

    public function deleteProgram(Program $program)
    {
        $header = array_merge($this->defaultHeader, [
            'Content-Type' => 'application/json;odata=minimalmetadata',
            'Accept' => 'application/json;odata=minimalmetadata'
        ]);

        return $this->restClient->send('Programs(\''.$program->getId().'\')', 'delete', [], [], $header);
    }

    public function getProgram($programId)
    {
        $header = array_merge($this->defaultHeader, [
            'Content-Type' => 'application/json;odata=minimalmetadata',
            'Accept' => 'application/json;odata=minimalmetadata'
        ]);

        return $this->restClient->send('Programs(\''.$programId.'\')', 'get', [], [], $header);
    }

    public function listPrograms(Channel $channel)
    {
        return $this->restClient->send('Channels(\''.$channel->getId().'\')/Programs', 'get', [], [], $this->defaultHeader, '');
    }

    public function publishAsset($policyName, $durationInMinutes, $asset)
    {
        $r = $this->restClient->send('AccessPolicies', 'post', [], [], $this->defaultHeader, [
            'Name' => $policyName,
            'DurationInMinutes' => (int)$durationInMinutes,
            'Permissions' => '1'
        ]);

        $now = new \DateTime();
        $r = $this->restClient->send('Locators', 'post', [], [], $this->defaultHeader, [
            'AccessPolicyId' => $r->getId(),
            'AssetId' => $asset instanceof Asset ? $asset->getId() : $asset,
            'StartTime' => $now->format('Y-m-d\TH:i:sP'),
            'Type' => '2'
        ]);
        return true;
    }

    protected function getAll(
        $url,
        $method,
        array $parameters = [],
        array $postParameters = [],
        array $header = [],
        $content = ''
    )
    {
        $skipping = 0;
        $newArr = [];
        $finish = false;
        while (!$finish) {
            $results = $this->restClient->send($url, $method, array_merge($parameters, ['$skip' => $skipping]), $postParameters, $header, $content);
            $skipping = 1000 + $skipping;
            $result = array_filter($results);
            if (empty($results)) {
                $finish = true;
            } else {
                $newArr = array_merge($newArr, $results);
            }
        }

        return $newArr;
    }
}