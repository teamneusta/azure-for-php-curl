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
                $value = $this->{$methodName}();
                if(is_object($value) && method_exists($value, 'toArray')) {
                    $arr[substr($methodName, 3)] = $value->toArray();
                } else if(is_array($value)) {
                    $collection = [];
                    foreach($value as $val) {
                        if(is_object($val) && method_exists($val, 'toArray')) {
                            $collection[] = $val->toArray();
                        } else {
                            $collection[] = $val;
                        }
                    }
                    $arr[substr($methodName, 3)] = $collection;
                } else if($value instanceof \DateTime) {
                    $arr[substr($methodName, 3)] = $value->format('c');
                } else {
                    $arr[substr($methodName, 3)] = $value;
                }
            }
        }
        $arr = array_filter($arr);
        return $arr;
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
            $methodName = 'add' . ucfirst($key);
            if (method_exists($this, $methodName)) {
                if(!empty($value['results'])) {
                    foreach($value['results'] as $result) {
                        $this->$methodName($result);
                    }
                }
            }
        }
    }

    /**
     * createFromOptions
     *
     * @param $options
     * @return static
     */
    public static function createFromOptions($options)
    {
        $class = static::class;
        $obj = new $class(0);
        $obj->fromArray($options);

        return $obj;
    }
}