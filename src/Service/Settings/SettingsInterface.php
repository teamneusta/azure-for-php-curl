<?php

namespace Bennsel\WindowsAzureCurl\Service\Settings;


interface SettingsInterface
{

    public function __construct($name, $key);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getKey();
}