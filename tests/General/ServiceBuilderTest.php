<?php

namespace Bennsel\WindowsAzureCurl\Tests\General\ServiceBuilder;


use Bennsel\WindowsAzureCurl\General\ServiceBuilder;
use Bennsel\WindowsAzureCurl\Service\Settings\MediaServiceSettings;
use Bennsel\WindowsAzureCurl\Service\Settings\SettingsInterface;
use Bennsel\WindowsAzureCurl\TestSettings;

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
        $this->assertInstanceOf('Bennsel\WindowsAzureCurl\Service\MediaService', $mediaService);
    }

    public function testShouldReturnMediaServiceThatIncludeServiceInterface()
    {
        $mediaService = ServiceBuilder::create('MediaService', $this->settings);
        $this->assertInstanceOf('Bennsel\WindowsAzureCurl\Service\ServiceInterface', $mediaService);
    }


}