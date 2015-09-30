<?php
namespace Bennsel\WindowsAzureCurl\Model\Media;
use Bennsel\WindowsAzureCurl\Filter\Edm;
use Bennsel\WindowsAzureCurl\Model\AbstractModel;


/**
 * Represents asset object used in media services
 *
 * @category  Microsoft
 * @package   WindowsAzure\MediaServices\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: 0.4.0_2014-01
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
class Asset extends AbstractModel
{
    /**
     * Asset id
     *
     * @var string
     */
    private $id;

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param int $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @param \DateTime $lastModified
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @param string $storageAccountName
     */
    public function setStorageAccountName($storageAccountName)
    {
        $this->storageAccountName = $storageAccountName;
    }

    /**
     * State
     *
     * @var int
     */
    private $state;

    /**
     * Created
     *
     * @var \DateTime
     */
    private $created;

    /**
     * Last modified
     *
     * @var \DateTime
     */
    private $lastModified;

    /**
     * Alternate id
     *
     * @var string
     */
    private $alternateId;

    /**
     * Name
     *
     * @var string
     */
    private $name;

    /**
     * Options
     *
     * @var int
     */
    private $options;

    /**
     * URI
     *
     * @var string
     */
    private $uri;

    /**
     * Storage account name
     *
     * @var string
     */
    private $storageAccountName;

    /**
     * Create asset from array
     *
     * @param array $options Array containing values for object properties
     *
     * @return Asset
     */
    public static function createFromOptions($options)
    {
        $asset = new Asset($options['Options']);
        $asset->fromArray($options);

        return $asset;
    }

    /**
     * Create asset
     *
     * @param int $options Asset encrytion options.
     *
     * @return none
     */
    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * Get "Storage account name"
     *
     * @return string
     */
    public function getStorageAccountName()
    {
        return $this->storageAccountName;
    }

    /**
     * Get "URI"
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Get "Options"
     *
     * @return int
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set "Options"
     *
     * @param int $value Options
     *
     * @return none
     */
    public function setOptions($value)
    {
        $this->options = $value;
    }

    /**
     * Get "Name"
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set "Name"
     *
     * @param string $value Name
     *
     * @return none
     */
    public function setName($value)
    {
        $this->name = $value;
    }

    /**
     * Get "Alternate id"
     *
     * @return string
     */
    public function getAlternateId()
    {
        return $this->alternateId;
    }

    /**
     * Set "Alternate id"
     *
     * @param string $value Alternate id
     *
     * @return none
     */
    public function setAlternateId($value)
    {
        $this->alternateId = $value;
    }

    /**
     * Get "Last modified"
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * Get "Created"
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get "State"
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get "Asset id"
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
