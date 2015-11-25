<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model\Media;

use TeamNeusta\WindowsAzureCurl\Model\AbstractModel;
use TeamNeusta\WindowsAzureCurl\Model\General\ModelInterface;

class AccessPolicies extends AbstractModel implements ModelInterface
{
    /**
     * id
     *
     * @var string
     */
    protected $id;

    /**
     * created
     *
     * @var \DateTime
     */
    protected $created;

    /**
     * lastModified
     *
     * @var \DateTime
     */
    protected $lastModified;

    /**
     * name
     *
     * @var string
     */
    protected $name;

    /**
     * durationInMinutes
     *
     * @var float
     */
    protected $durationInMinutes;
    /**
     * permissions
     *
     * @var int
     */
    protected $permissions;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @param \DateTime $lastModified
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }

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
     * @return float
     */
    public function getDurationInMinutes()
    {
        return $this->durationInMinutes;
    }

    /**
     * @param float $durationInMinutes
     */
    public function setDurationInMinutes($durationInMinutes)
    {
        $this->durationInMinutes = $durationInMinutes;
    }

    /**
     * @return int
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param int $permissions
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }
}