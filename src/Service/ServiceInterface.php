<?php
namespace Bennsel\WindowsAzureCurl\Service;


use Bennsel\WindowsAzureCurl\Service\Settings\SettingsInterface;

interface ServiceInterface
{

    public function __construct(SettingsInterface $settings);
}