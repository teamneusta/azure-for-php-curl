<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/

namespace Bennsel\WindowsAzureCurl\General;


use Curl\Curl;

class RestClient
{
    public function send($url, $method, array $parameters = [], array $postParameters = [], array $header = [])
    {
        $curl = new Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);

        $curl->setHeader('Content-Type', 'application/x-www-form-urlencoded');
        foreach($header as $key => $value) {
            $curl->setHeader($key, $value);
        }

        $method = strtolower($method);
        return $curl->$method($url, $postParameters);
    }
}