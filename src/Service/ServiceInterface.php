<?php
namespace TeamNeusta\WindowsAzureCurl\Service;


use TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsInterface;

interface ServiceInterface
{

    public function __construct(SettingsInterface $settings);
}