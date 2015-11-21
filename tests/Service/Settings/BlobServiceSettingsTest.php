<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Tests\Service\Settings;


use TeamNeusta\WindowsAzureCurl\Service\Settings\BlobServiceSettings;
use TeamNeusta\WindowsAzureCurl\TestSettings;

class BlobServiceSettingsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * mediaServiceSettings
     *
     * @var BlobServiceSettings
     */
    protected $blobServiceSettings;


    protected function setUp()
    {
        $this->blobServiceSettings = new BlobServiceSettings(TestSettings::AUTH_BLOB_SERVICE_NAME, TestSettings::AUTH_BLOB_SERVICE_KEY);
    }

    public function testShouldControlImplementationOfSettingsInterface()
    {
        $this->assertInstanceOf('TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsInterface', $this->blobServiceSettings);
    }

    public function testShouldControlExtendingFromSettingsAbstract()
    {
        $this->assertInstanceOf('TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsAbstract', $this->blobServiceSettings);
    }

    public function testShouldControlIfConstructorArgumentNameAreSetTheValue()
    {
        $this->assertSame($this->blobServiceSettings->getName(), TestSettings::AUTH_BLOB_SERVICE_NAME);
    }

    public function testShouldControlIfConstructorArgumentKeyAreSetTheValue()
    {
        $this->assertSame($this->blobServiceSettings->getKey(), TestSettings::AUTH_BLOB_SERVICE_KEY);
    }

}
