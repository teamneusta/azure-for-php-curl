<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model\Media;
use TeamNeusta\WindowsAzureCurl\Filter\Edm;
use TeamNeusta\WindowsAzureCurl\Model\AbstractModel;

class Program extends AbstractModel
{
    /**
     * id
     *
     * @var string
     */
    protected $id;

    /**
     * name
     *
     * @var string
     */
    protected $name;

    /**
     * assetId
     *
     * @var string
     */
    protected $assetId;

    /**
     * created
     *
     * @var \DateTime
     */
    protected $created;

    /**
     * description
     *
     * @var string
     */
    protected $description;

    /**
     * archiveWindowLength
     *
     * @var int
     */
    protected $archiveWindowLength;

    /**
     * lastModified
     *
     * @var \DateTime
     */
    protected $lastModified;

    /**
     * manifestName
     *
     * @var string
     */
    protected $manifestName;

    /**
     * state
     *
     * @var string
     */
    protected $state;
    /**
     * channelId
     *
     * @var string
     */
    protected $channelId;

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
    public function getAssetId()
    {
        return $this->assetId;
    }

    /**
     * @param string $assetId
     */
    public function setAssetId($assetId)
    {
        $this->assetId = $assetId;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getArchiveWindowLength()
    {
        return $this->archiveWindowLength;
    }

    /**
     * @param int $archiveWindowLength
     */
    public function setArchiveWindowLength($archiveWindowLength)
    {
        $this->archiveWindowLength = $archiveWindowLength;
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
    public function getManifestName()
    {
        return $this->manifestName;
    }

    /**
     * @param string $manifestName
     */
    public function setManifestName($manifestName)
    {
        $this->manifestName = $manifestName;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * @param string $channelId
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;
    }

    public function setChannel(Channel $channel)
    {
        $this->setChannelId($channel->getId());
    }

    public function setAsset(Asset $asset)
    {
        $this->setAssetId($asset->getId());
    }
}
