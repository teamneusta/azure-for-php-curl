<?php

namespace Bennsel\WindowsAzureCurl\Service\Settings;


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

    public function __construct($name, $key)
    {
        $this->name = $name;
        $this->key = $key;
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