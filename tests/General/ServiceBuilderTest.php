<?php

namespace TeamNeusta\WindowsAzureCurl\Tests\General\ServiceBuilder;


use TeamNeusta\WindowsAzureCurl\General\ServiceBuilder;
use TeamNeusta\WindowsAzureCurl\Service\Settings\MediaServiceSettings;
use TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsInterface;
use TeamNeusta\WindowsAzureCurl\TestSettings;

class ServiceBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * settings
     *
     * @var SettingsInterface
     */
    protected $settings;

    protected function setUp()
    {
        $this->settings = new MediaServiceSettings(TestSettings::AUTH_MEDIA_SERVICE_NAME, TestSettings::AUTH_MEDIA_SERVICE_KEY);
    }


    /**
     * testShouldReturnExceptionIfServiceClassNotExist
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Service someMissingService not found
     * @return void
     * @throws \Exception
     */
    public function testShouldReturnExceptionIfServiceClassNotExist()
    {
        ServiceBuilder::create('someMissingService', $this->settings);
    }

    public function testShouldReturnMediaServiceClass()
    {
        $mediaService = ServiceBuilder::create('MediaService', $this->settings);
        $this->assertInstanceOf('TeamNeusta\WindowsAzureCurl\Service\MediaService', $mediaService);
    }

    public function testShouldReturnBlobServiceClass()
    {
        $blobService = ServiceBuilder::create('BlobService', $this->settings);
        $this->assertInstanceOf('TeamNeusta\WindowsAzureCurl\Service\BlobService', $blobService);
    }

    public function testShouldReturnMediaServiceThatIncludeServiceInterface()
    {
        $mediaService = ServiceBuilder::create('MediaService', $this->settings);
        $this->assertInstanceOf('TeamNeusta\WindowsAzureCurl\Service\ServiceInterface', $mediaService);
    }


}
