<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace Bennsel\WindowsAzureCurl\Model\General;

class ResponseModelMapping {

    protected static $mapping = [
        '/^Assets$/i' => '\Bennsel\WindowsAzureCurl\Model\Media\Asset',
        '/^Jobs$/i' => '\Bennsel\WindowsAzureCurl\Model\Media\Job',
        '/^Jobs\(.*\)\/OutputMediaAssets/i' => '\Bennsel\WindowsAzureCurl\Model\Media\Asset'
    ];

    /**
     * create
     *
     * @param string $type
     * @param string $response
     * @return mixed
     */
    public static function create($type, $response)
    {
        $className = '';
        if(!empty($type)) {
            foreach(self::$mapping as $key => $class) {
                if(preg_match($key, $type) > 0) {
                    $className = $class;
                }
            }
        }

        if(!empty($className)) {
            $json = json_encode($response);
            $array = json_decode($json, TRUE);
            $results = [];
            if (!empty($array['d']['results'])) {
                $results = $array['d']['results'];
            }

            $finalArray = [];

            if(count($results)) {
                foreach($results as $entry) {
                    $objectClassName = $className;
                    $newObject = $objectClassName::createFromOptions($entry);
                    $finalArray[] = $newObject;
                }
            }

            return $finalArray;
        }
        return $response;
    }
}