<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model\General;

class ResponseModelMapping {

    protected static $mapping = [
        '/^Assets$/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\Asset',
        '/^Jobs/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\Job',
        '/^Channels$/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\Channel',
        '/^Programs$/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\Program',
        '/^Files/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\File',
        '/^AccessPolicies$/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\AccessPolicies',
        '/^Jobs\(.*\)\/OutputMediaAssets/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\Asset',
        '/Channels\(.*\)\/Programs$/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\Program',
        '/Programs\(.*\)\/Channel$/i' => '\TeamNeusta\WindowsAzureCurl\Model\Media\Channel'
    ];

    public static $enableMapping = true;

    /**
     * create
     *
     * @param string $type
     * @param string $response
     * @return mixed
     */
    public static function create($type, $response, $client, $analyzed = true)
    {
        $className = '';
        if(!empty($type) && self::$enableMapping === true) {
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
                return $className::createFromOptions(self::analyzedDeferred($array, [$client, $analyzed]));
            } else if(!empty($array['d']['__metadata'])) {
                return $className::createFromOptions(self::analyzedDeferred($array['d'], [$client, $analyzed]));
            } else {
                $results = [];
                if (!empty($array['d']['results'])) {
                    $results = $array['d']['results'];
                }

                $finalArray = [];

                if(count($results)) {
                    foreach($results as $entry) {
                        $objectClassName = $className;
                        $newObject = $objectClassName::createFromOptions(self::analyzedDeferred($entry, [$client, $analyzed]));
                        $finalArray[] = $newObject;
                    }
                }

                return $finalArray;
            }
        }

        if (!empty($response['d']['results']) || isset($response['d']['results'])) {
            return $response['d']['results'];
        }
        return $response;
    }

    protected static function analyzedDeferred($r, $clientParams)
    {
        array_walk($r, ['self', 'addDeferred'], $clientParams);
        return array_filter($r);
    }

    protected static function addDeferred(&$item, $key, $clientParams) {
        list($client, $recursiv) = $clientParams;
        if(is_array($item)) {
            array_walk($item, ['self', 'addDeferred'], $clientParams);
            $item = array_filter($item);
            if(!empty($item['__deferred'])) {
                $item = $item['__deferred'];
            }
        }
        if($key === '__deferred' && !empty($item['uri'])) {
            if($recursiv) {
                $item = $client->send($item['uri'], 'get', [], [], [], '', false);
            } else {
                $item = '';
            }
        }
    }
}