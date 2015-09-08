<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace Bennsel\WindowsAzureCurl\Filter;

class Edm {
    public static function filter($argument)
    {
        preg_match_all('/^\/(.*)\((.*)\)\/$/', $argument, $matches);
        if(count($matches) > 1) {
            $filterName = current($matches[1]);
            $arguments = $matches[2];
            return call_user_func_array(array(__NAMESPACE__ .'\\'.$filterName, 'filter'), $arguments ?: []);
        }
    }
}