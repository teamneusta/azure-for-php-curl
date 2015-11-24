<?php

namespace TeamNeusta\WindowsAzureCurl\Service\Settings;


class SettingsAbstract implements SettingsInterface
{
    /**
     * name
     *
     * @var string
     */
    protected $name;

    /**
     * key
     *
     * @var string
     */
    protected $key;

    /**
     * httpClient
     *
     * @var string
     */
    protected $httpClient = 'CurlClient';

    public function __construct($name, $key)
    {
        $this->name = $name;
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param string $httpClient
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}