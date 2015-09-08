<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace Bennsel\WindowsAzureCurl\Filter;

class Edm {
    public static function filter($argument)
    {
        if(is_string($argument)) {
            preg_match_all('/^\/(.*)\((.*)\)\/$/', $argument, $matches);
            if(count($matches) > 1) {
                $filterName = current($matches[1]);
                $className = __NAMESPACE__ .'\\'.$filterName;
                $arguments = $matches[2];
                if(class_exists($className)) {
                    return call_user_func_array(array($className, 'filter'), $arguments ?: []);
                }
            }
        } else if (is_array($argument)) {
            if(!empty($argument['__deferred'])) {

            }
        }
        return $argument;
    }
}