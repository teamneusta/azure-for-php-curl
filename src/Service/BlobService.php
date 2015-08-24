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
        $this->restClient = new RestClient('https://'.$this->settings->getName().'.blob.core.windows.net', $settings, 'BlobAuthorization');
        $date = gmdate("D, d M Y H:i:s") . ' GMT';
        $this->defaultHeader['x-ms-date'] = $date;
        $this->defaultHeader['x-ms-version'] = '2013-08-15';
    }

    public function listContainers()
    {
        return $this->restClient->send('/', 'GET', ['comp' => 'list'], [], $this->defaultHeader);
    }
}