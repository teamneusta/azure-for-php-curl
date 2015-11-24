<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model\Media;

use TeamNeusta\WindowsAzureCurl\Model\AbstractModel;
use TeamNeusta\WindowsAzureCurl\Model\General\ModelInterface;

class ChannelPreview extends AbstractModel implements ModelInterface
{
    /**
     * accessControl
     *
     * @var ChannelInputAccessControl
     */
    protected $accessControl;

    /**
     * endpoints
     *
     * @var array
     */
    protected $endpoints = [];

    /**
     * @return array
     */
    public function getEndpoints()
    {
        return $this->endpoints;
    }

    /**
     * addEndpoints
     *
     * @param $endpoints
     * @return void
     */
    public function addEndpoints($endpoints) {
        if(is_array($endpoints)) {
            $this->allow[] = ChannelEndpoint::createFromOptions($endpoints);
        } else {
            $this->allow[] = $endpoints;
        }
    }

    /**
     * @return ChannelInputAccessControl
     */
    public function getAccessControl()
    {
        return $this->accessControl;
    }

    /**
     * @param ChannelInputAccessControl $accessControl
     */
    public function setAccessControl($accessControl)
    {
        if(is_array($accessControl)) {
            $this->accessControl = ChannelInputAccessControl::createFromOptions($accessControl);
        } else {
            $this->accessControl = $accessControl;
        }
    }
}