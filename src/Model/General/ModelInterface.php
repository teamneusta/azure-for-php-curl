<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model\General;

use TeamNeusta\WindowsAzureCurl\Model\Media\Asset;

interface ModelInterface
{
    public function toArray();

    /**
     * Create asset from array
     *
     * @param array $options Array containing values for object properties
     *
     * @return Asset
     */
    public static function createFromOptions($options);
}