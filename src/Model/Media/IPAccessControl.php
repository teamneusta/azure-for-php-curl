<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model\Media;

use TeamNeusta\WindowsAzureCurl\Model\AbstractModel;
use TeamNeusta\WindowsAzureCurl\Model\General\ModelInterface;

class IPAccessControl extends AbstractModel implements ModelInterface
{

    /**
     * allow
     *
     * @var array
     */
    protected $allow = [];

    /**
     * @return array
     */
    public function getAllow()
    {
        return $this->allow;
    }

    public function addAllow($allow) {
        if(is_array($allow)) {
            $this->allow[] = IPRange::createFromOptions($allow);
        } else {
            $this->allow[] = $allow;
        }
    }
}