<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

namespace Bennsel\WindowsAzureCurl\Model;


abstract class AbstractModel
{
    public function __construct(\stdClass $arguments)
    {
        foreach($arguments as $k => $value) {
            $method = 'set' . $this->toCamelCase($k, true);
            $this->$method($value);
        }
    }

    /**
     * Translates a string with underscores
     * into camel case (e.g. first_name -> firstName)
     *
     * @param string $str String in underscore format
     * @param bool $capitalise_first_char If true, capitalise the first char in $str
     * @return string $str translated into camel caps
     */
    public function toCamelCase($str, $capitalise_first_char = false) {
        if($capitalise_first_char) {
            $str[0] = strtoupper($str[0]);
        }
        $func = create_function('$c', 'return strtoupper($c[1]);');
        return preg_replace_callback('/_([a-z])/', $func, $str);
    }

    public function toArray()
    {
        $methods = get_class_methods(get_class($this));
        $arr = [];
        foreach($methods as $methodName) {
            if(strpos($methodName, 'get') !== false) {
                $arr[substr($methodName, 3)] = $this->{$methodName}();
            }
        }
        $arr = array_filter($arr);
        return $arr;
        return json_encode($arr);
    }
}