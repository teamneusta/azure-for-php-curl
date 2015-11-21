<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Filter;

class Edm {
    private static $matchesPattern = [
        'Edm' => '/^\/(.*)\((.*)\)\/$/',
        'Date' => '/^(\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.*)$/'
    ];

    protected static function getMatches($subject) {
        foreach(self::$matchesPattern as $type => $pattern) {
            $matches = [];
            preg_match_all($pattern, $subject, $matches);
            $matches = array_filter($matches);
            if(count($matches) > 1) {
                if($type !== 'Edm') {
                    $matches = array_merge([[]], [[$type]], array_slice($matches, 1));
                }
                return $matches;
            }
        }
        return [];
    }

    public static function filter($argument)
    {
        if(is_string($argument)) {
            $matches = self::getMatches($argument);
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