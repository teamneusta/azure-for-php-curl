<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model\Media;

use TeamNeusta\WindowsAzureCurl\Model\AbstractModel;
use TeamNeusta\WindowsAzureCurl\Model\General\ModelInterface;

class IPRange extends AbstractModel implements ModelInterface
{

    /**
     * name
     *
     * @var string
     */
    protected $name;

    /**
     * address
     *
     * @var string
     */
    protected $address;
    /**
     * subnetPrefixLength
     *
     * @var int
     */
    protected $subnetPrefixLength;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getSubnetPrefixLength()
    {
        return $this->subnetPrefixLength;
    }

    /**
     * @param int $subnetPrefixLength
     */
    public function setSubnetPrefixLength($subnetPrefixLength)
    {
        $this->subnetPrefixLength = $subnetPrefixLength;
    }
}