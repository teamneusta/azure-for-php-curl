<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model;


use TeamNeusta\WindowsAzureCurl\Filter\Edm;

abstract class AbstractModel
{
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

    /**
     * fromArray
     *
     * @param array $options
     * @return void
     */
    public function fromArray(array $options)
    {
        foreach ($options as $key => $value) {
            $methodName = 'set' . ucfirst($key);
            if (method_exists($this, $methodName)) {
                $this->$methodName(Edm::filter($value));
            }
        }
    }
}