<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace Bennsel\WindowsAzureCurl\Filter;

class Date {
    public static function filter($date)
    {
        if(!$date instanceof \DateTime) {
            if(strlen($date) >= 10 && is_numeric($date)) {
                $dateString = $date;
                $date = new \DateTime('now');
                $date->setTimestamp(substr($dateString, 0, 10));
            } else {
                $date = new \DateTime($date);
            }
        }
        return $date;
    }
}