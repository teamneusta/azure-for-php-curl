<?php

namespace TeamNeusta\WindowsAzureCurl\General;

use TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsInterface;

class ServiceBuilder
{
    public static function create($serviceName, SettingsInterface $settings)
    {
        $className = 'TeamNeusta\\WindowsAzureCurl\\Service\\' . $serviceName;
        if (class_exists($className) === true) {
            return new $className($settings);
        } else {
            throw new \Exception('Service ' . $serviceName . ' not found');
        }
    }
}