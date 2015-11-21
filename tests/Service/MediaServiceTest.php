<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/

namespace TeamNeusta\WindowsAzureCurl\Tests\Service;


use TeamNeusta\WindowsAzureCurl\Service\MediaService;
use TeamNeusta\WindowsAzureCurl\Service\Settings\MediaServiceSettings;
use TeamNeusta\WindowsAzureCurl\TestSettings;

class MediaServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * mediaService
     *
     * @var MediaService
     */
    protected $mediaService;

    /**
     * settings
     *
     * @var MediaServiceSettings
     */
    protected $settings;

    public function setUp()
    {
        $this->settings = new MediaServiceSettings(TestSettings::AUTH_MEDIA_SERVICE_NAME, TestSettings::AUTH_MEDIA_SERVICE_KEY);
        $this->mediaService = new MediaService($this->settings);
    }

    /**
     * getJobListMethodShouldBeExist
     *
     * @test
     * @return void
     */
    public function getJobListMethodShouldBeExist()
    {
        $this->assertTrue(is_array($this->mediaService->getJobList()));
    }
}
