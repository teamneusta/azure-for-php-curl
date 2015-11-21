<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/

namespace TeamNeusta\WindowsAzureCurl\Tests\Service\Settings;


use TeamNeusta\WindowsAzureCurl\Service\Settings\MediaServiceSettings;
use TeamNeusta\WindowsAzureCurl\TestSettings;

class MediaServiceSettingsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * mediaServiceSettings
     *
     * @var MediaServiceSettings
     */
    protected $mediaServiceSettings;


    protected function setUp()
    {
        $this->mediaServiceSettings = new MediaServiceSettings(TestSettings::AUTH_MEDIA_SERVICE_NAME, TestSettings::AUTH_MEDIA_SERVICE_KEY);
    }

    public function testShouldControlImplementationOfSettingsInterface()
    {
        $this->assertInstanceOf('TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsInterface', $this->mediaServiceSettings);
    }

    public function testShouldControlExtendingFromSettingsAbstract()
    {
        $this->assertInstanceOf('TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsAbstract', $this->mediaServiceSettings);
    }

    public function testShouldControlIfConstructorArgumentNameAreSetTheValue()
    {
        $this->assertSame($this->mediaServiceSettings->getName(), TestSettings::AUTH_MEDIA_SERVICE_NAME);
    }

    public function testShouldControlIfConstructorArgumentKeyAreSetTheValue()
    {
        $this->assertSame($this->mediaServiceSettings->getKey(), TestSettings::AUTH_MEDIA_SERVICE_KEY);
    }

}
