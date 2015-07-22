<?php

namespace Bennsel\WindowsAzureCurl\Tests\General\ServiceBuilder;


use Bennsel\WindowsAzureCurl\General\ServiceBuilder;
use Bennsel\WindowsAzureCurl\Service\Settings\MediaServiceSettings;

class ServiceBuilderTest extends \PHPUnit_Framework_TestCase
{

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
        ServiceBuilder::create('someMissingService', new MediaServiceSettings());
    }

    public function testShouldReturnMediaServiceClass()
    {
        $mediaService = ServiceBuilder::create('MediaService', new MediaServiceSettings());
        $this->assertInstanceOf('Bennsel\WindowsAzureCurl\Service\MediaService', $mediaService);
    }

    public function testShouldReturnMediaServiceThatIncludeServiceInterface()
    {
        $mediaService = ServiceBuilder::create('MediaService', new MediaServiceSettings());
        $this->assertInstanceOf('Bennsel\WindowsAzureCurl\Service\ServiceInterface', $mediaService);
    }


}
