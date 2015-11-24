<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model\Media;

use TeamNeusta\WindowsAzureCurl\Model\AbstractModel;
use TeamNeusta\WindowsAzureCurl\Model\General\ModelInterface;

class ChannelInput extends AbstractModel implements ModelInterface
{
    /**
     * keyFrameInterval
     *
     * @var int
     */
    protected $keyFrameInterval;
    /**
     * streamingProtocol
     *
     * @var string
     */
    protected $streamingProtocol;

    /**
     * accessControl
     *
     * @var ChannelInputAccessControl
     */
    protected $accessControl;

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

    /**
     * @return int
     */
    public function getKeyFrameInterval()
    {
        return $this->keyFrameInterval;
    }

    /**
     * @param int $keyFrameInterval
     */
    public function setKeyFrameInterval($keyFrameInterval)
    {
        $this->keyFrameInterval = $keyFrameInterval;
    }

    /**
     * @return string
     */
    public function getStreamingProtocol()
    {
        return $this->streamingProtocol;
    }

    /**
     * @param string $streamingProtocol
     */
    public function setStreamingProtocol($streamingProtocol)
    {
        $this->streamingProtocol = $streamingProtocol;
    }
}