<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model\Media;

use TeamNeusta\WindowsAzureCurl\Model\AbstractModel;
use TeamNeusta\WindowsAzureCurl\Model\General\ModelInterface;

class ChannelInputAccessControl extends AbstractModel implements ModelInterface
{
    /**
     * IP
     *
     * @var IPAccessControl
     */
    protected $IP;

    /**
     * @return IPAccessControl
     */
    public function getIP()
    {
        return $this->IP;
    }

    /**
     * @param IPAccessControl $IP
     */
    public function setIP($IP)
    {
        if(is_array($IP)) {
            $this->IP = IPAccessControl::createFromOptions($IP);
        } else {
            $this->IP = $IP;
        }
    }
}