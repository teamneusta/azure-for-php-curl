<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model\Media;

use TeamNeusta\WindowsAzureCurl\Model\AbstractModel;
use TeamNeusta\WindowsAzureCurl\Model\General\ModelInterface;

class Encoding extends AbstractModel implements ModelInterface
{
    /**
     * adMarkerSource
     *
     * @var string
     */
    protected $adMarkerSource;
    /**
     * ignoreCea708ClosedCaptions
     *
     * @var bool
     */
    protected $ignoreCea708ClosedCaptions;
    /**
     * systemPreset
     *
     * @var string
     */
    protected $systemPreset;

    /**
     * @return string
     */
    public function getAdMarkerSource()
    {
        return $this->adMarkerSource;
    }

    /**
     * @param string $adMarkerSource
     */
    public function setAdMarkerSource($adMarkerSource)
    {
        $this->adMarkerSource = $adMarkerSource;
    }

    /**
     * @return boolean
     */
    public function isIgnoreCea708ClosedCaptions()
    {
        return $this->ignoreCea708ClosedCaptions;
    }

    /**
     * @param boolean $ignoreCea708ClosedCaptions
     */
    public function setIgnoreCea708ClosedCaptions($ignoreCea708ClosedCaptions)
    {
        $this->ignoreCea708ClosedCaptions = $ignoreCea708ClosedCaptions;
    }

    /**
     * @return string
     */
    public function getSystemPreset()
    {
        return $this->systemPreset;
    }

    /**
     * @param string $systemPreset
     */
    public function setSystemPreset($systemPreset)
    {
        $this->systemPreset = $systemPreset;
    }
}