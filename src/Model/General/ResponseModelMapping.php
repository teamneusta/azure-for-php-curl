<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model\General;

class ResponseModelMapping {

    protected static $mapping = [
        '/^Assets$/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\Asset',
        '/^Jobs$/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\Job',
        '/^Channels$/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\Channel',
        '/^Files/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\File',
        '/^Jobs\(.*\)\/OutputMediaAssets/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\Asset'
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
            if(!empty($array['odata.metadata']) || !empty($array['Id'])) {
                return $className::createFromOptions($array);
            } else {
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
        }
        return $response;
    }
}