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

namespace Bennsel\WindowsAzureCurl\Tests\Service\Settings;


use Bennsel\WindowsAzureCurl\Service\Settings\MediaServiceSettings;
use Bennsel\WindowsAzureCurl\TestSettings;

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
        $this->assertInstanceOf('Bennsel\WindowsAzureCurl\Service\Settings\SettingsInterface', $this->mediaServiceSettings);
    }

    public function testShouldControlExtendingFromSettingsAbstract()
    {
        $this->assertInstanceOf('Bennsel\WindowsAzureCurl\Service\Settings\SettingsAbstract', $this->mediaServiceSettings);
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
