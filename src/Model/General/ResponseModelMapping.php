<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace Bennsel\WindowsAzureCurl\Model\General;

class ResponseModelMapping {

    protected static $mapping = [
        'assets' => '\Bennsel\WindowsAzureCurl\Model\Media\Asset',
        'jobs' => '\Bennsel\WindowsAzureCurl\Model\Media\Job'
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
        if(!empty(self::$mapping[strtolower($type)])) {
            $json = json_encode($response);
            $array = json_decode($json, TRUE);
            $results = [];
            if (!empty($array['d']['results'])) {
                $results = $array['d']['results'];
            }

            $finalArray = [];

            if(count($results)) {
                foreach($results as $entry) {
                    $objectClassName = self::$mapping[strtolower($type)];
                    $newObject = $objectClassName::createFromOptions($entry);
                    $finalArray[] = $newObject;
                }
            }

            return $finalArray;
        }
        return $response;
    }
}