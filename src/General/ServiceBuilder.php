<?php

namespace Bennsel\WindowsAzureCurl\General;

use Bennsel\WindowsAzureCurl\Service\Settings\SettingsInterface;

class ServiceBuilder
{
    public static function create($serviceName, SettingsInterface $settings)
    {
        $className = 'Bennsel\\WindowsAzureCurl\\Service\\' . $serviceName;
        if (class_exists($className) === true) {
            return new $className($settings);
        } else {
            throw new \Exception('Service ' . $serviceName . ' not found');
        }
    }
}