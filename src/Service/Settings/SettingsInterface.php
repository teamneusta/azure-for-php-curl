<?php

namespace TeamNeusta\WindowsAzureCurl\Service\Settings;


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

    /**
     * @return string
     */
    public function getHttpClient();

    /**
     * @param string $httpClient
     */
    public function setHttpClient($httpClient);
}