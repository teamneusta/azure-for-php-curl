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
     * The state of the asset "initialized"
     *
     * @var int
     */
    const STATE_INITIALIZED = 0;

    /**
     * The state of the asset "published"
     *
     * @var int
     */
    const STATE_PUBLISHED = 1;

    /**
     * The state of the asset "deleted"
     *
     * @var int
     */
    const STATE_DELETED = 2;

    /**
     * The encryption options "none"
     *
     * @var int
     */
    const OPTIONS_NONE = 0;

    /**
     * The encryption options "storage encrypted"
     *
     * @var int
     */
    const OPTIONS_STORAGE_ENCRYPTED = 1;

    /**
     * The encryption options "common encryption protected"
     *
     * @var int
     */
    const OPTIONS_COMMON_ENCRYPTION_PROTECTED = 2;

    /**
     * The encryption options "envelope encryption protected"
     *
     * @var int
     */
    const OPTIONS_ENVELOPE_ENCRYPTION_PROTECTED = 4;

    /**
     * Asset id
     *
     * @var string
     */
    private $_id;

    /**
     * State
     *
     * @var int
     */
    private $_state;

    /**
     * Created
     *
     * @var \DateTime
     */
    private $_created;

    /**
     * Last modified
     *
     * @var \DateTime
     */
    private $_lastModified;

    /**
     * Alternate id
     *
     * @var string
     */
    private $_alternateId;

    /**
     * Name
     *
     * @var string
     */
    private $_name;

    /**
     * Options
     *
     * @var int
     */
    private $_options;

    /**
     * URI
     *
     * @var string
     */
    private $_uri;

    /**
     * Storage account name
     *
     * @var string
     */
    private $_storageAccountName;

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
     * Fill asset from array
     *
     * @param array $options Array containing values for object properties
     *
     * @return none
     */
    public function fromArray($options)
    {
        if (isset($options['Id'])) {
            $this->_id = $options['Id'];
        }

        if (isset($options['State'])) {
            $this->_state = $options['State'];
        }

        if (isset($options['Created'])) {
            $this->_created = Edm::filter($options['Created']);
        }

        if (isset($options['LastModified'])) {
            $this->_lastModified = Edm::filter($options['LastModified']);
        }

        if (isset($options['AlternateId'])) {
            $this->_alternateId = $options['AlternateId'];
        }

        if (isset($options['Name'])) {
            $this->_name = $options['Name'];
        }

        if (isset($options['Options'])) {
            $this->_options = $options['Options'];
        }

        if (isset($options['Uri'])) {
            $this->_uri = $options['Uri'];
        }

        if (isset($options['StorageAccountName'])) {
            $this->_storageAccountName = $options['StorageAccountName'];
        }
    }

    /**
     * Get "Storage account name"
     *
     * @return string
     */
    public function getStorageAccountName()
    {
        return $this->_storageAccountName;
    }

    /**
     * Get "URI"
     *
     * @return string
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * Get "Options"
     *
     * @return int
     */
    public function getOptions()
    {
        return $this->_options;
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
        $this->_options = $value;
    }

    /**
     * Get "Name"
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
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
        $this->_name = $value;
    }

    /**
     * Get "Alternate id"
     *
     * @return string
     */
    public function getAlternateId()
    {
        return $this->_alternateId;
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
        $this->_alternateId = $value;
    }

    /**
     * Get "Last modified"
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->_lastModified;
    }

    /**
     * Get "Created"
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->_created;
    }

    /**
     * Get "State"
     *
     * @return int
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Get "Asset id"
     *
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }
}


