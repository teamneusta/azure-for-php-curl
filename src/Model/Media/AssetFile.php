<?php
namespace Bennsel\WindowsAzureCurl\Model\Media;
/**
 * Represents asset file object used in media services
 *
 * @category  Microsoft
 * @package   WindowsAzure\MediaServices\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: 0.4.0_2014-01
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
class AssetFile
{
    /**
     * Asset file Id
     *
     * @var string
     */
    private $_id;

    /**
     * Name
     *
     * @var string
     */
    private $_name;

    /**
     * Content file size
     *
     * @var int
     */
    private $_contentFileSize;

    /**
     * Parent asset id
     *
     * @var string
     */
    private $_parentAssetId;

    /**
     * Encryption version
     *
     * @var string
     */
    private $_encryptionVersion;

    /**
     * Encryption scheme
     *
     * @var string
     */
    private $_encryptionScheme;

    /**
     * Is encrypted
     *
     * @var bool
     */
    private $_isEncrypted;

    /**
     * Encryption key id
     *
     * @var string
     */
    private $_encryptionKeyId;

    /**
     * Initialization vector
     *
     * @var string
     */
    private $_initializationVector;

    /**
     * Is primary
     *
     * @var bool
     */
    private $_isPrimary;

    /**
     * Last modified
     *
     * @var \DateTime
     */
    private $_lastModified;

    /**
     * Created
     *
     * @var \DateTime
     */
    private $_created;

    /**
     * Mime type
     *
     * @var string
     */
    private $_mimeType;

    /**
     * Content check sum
     *
     * @var string
     */
    private $_contentCheckSum;

    /**
     * Create asset file from array
     *
     * @param array $options Array containing values for object properties
     *
     * @return AssetFile
     */
    public static function createFromOptions($options)
    {
        $assetFile = new AssetFile($options['Name'], $options['ParentAssetId']);
        $assetFile->fromArray($options);

        return $assetFile;
    }

    /**
     * Create asset file
     *
     * @param string $name          Friendly name for asset file.
     * @param string $parentAssetId Asset Id of the Asset that this file is
     *                              associated with.
     */
    public function __construct($name, $parentAssetId)
    {
        $this->_name          = $name;
        $this->_parentAssetId = $parentAssetId;
    }

    /**
     * Fill asset file from array
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

        if (isset($options['Name'])) {
            $this->_name = $options['Name'];
        }

        if (isset($options['ContentFileSize'])) {
            $this->_contentFileSize = $options['ContentFileSize'];
        }

        if (isset($options['ParentAssetId'])) {
            $this->_parentAssetId = $options['ParentAssetId'];
        }

        if (isset($options['EncryptionVersion'])) {
            $this->_encryptionVersion = $options['EncryptionVersion'];
        }

        if (isset($options['EncryptionScheme'])) {
            $this->_encryptionScheme = $options['EncryptionScheme'];
        }

        if (isset($options['IsEncrypted'])) {
            $this->_isEncrypted = $options['IsEncrypted'];
        }

        if (isset($options['EncryptionKeyId'])) {
            $this->_encryptionKeyId = $options['EncryptionKeyId'];
        }

        if (isset($options['InitializationVector'])) {
            $this->_initializationVector = $options['InitializationVector'];
        }

        if (isset($options['IsPrimary'])) {
            $this->_isPrimary = $options['IsPrimary'];
        }

        if (isset($options['LastModified'])) {
            $this->_lastModified = new \DateTime($options['LastModified']);
        }

        if (isset($options['Created'])) {
            $this->_created = new \DateTime($options['Created']);
        }

        if (isset($options['MimeType'])) {
            $this->_mimeType = $options['MimeType'];
        }

        if (isset($options['ContentChecksum'])) {
            $this->_contentCheckSum = $options['ContentChecksum'];
        }
    }

    /**
     * Get "Content check sum"
     *
     * @return string
     */
    public function getContentCheckSum()
    {
        return $this->_contentCheckSum;
    }

    /**
     * Set "Content check sum"
     *
     * @param string $value Content check sum
     *
     * @return none
     */
    public function setContentCheckSum($value)
    {
        $this->_contentCheckSum = $value;
    }

    /**
     * Get "Mime type"
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->_mimeType;
    }

    /**
     * Set "Mime type"
     *
     * @param string $value Mime type
     *
     * @return none
     */
    public function setMimeType($value)
    {
        $this->_mimeType = $value;
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
     * Get "Last modified"
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->_lastModified;
    }

    /**
     * Get "Is primary"
     *
     * @return bool
     */
    public function getIsPrimary()
    {
        return $this->_isPrimary;
    }

    /**
     * Set "Is primary"
     *
     * @param bool $value Is primary
     *
     * @return none
     */
    public function setIsPrimary($value)
    {
        $this->_isPrimary = $value;
    }

    /**
     * Get "Initialization vector"
     *
     * @return string
     */
    public function getInitializationVector()
    {
        return $this->_initializationVector;
    }

    /**
     * Set "Initialization vector"
     *
     * @param string $value Initialization vector
     *
     * @return none
     */
    public function setInitializationVector($value)
    {
        $this->_initializationVector = $value;
    }

    /**
     * Get "Encryption key id"
     *
     * @return string
     */
    public function getEncryptionKeyId()
    {
        return $this->_encryptionKeyId;
    }

    /**
     * Set "Encryption key id"
     *
     * @param string $value Encryption key id
     *
     * @return none
     */
    public function setEncryptionKeyId($value)
    {
        $this->_encryptionKeyId = $value;
    }

    /**
     * Get "Is encrypted"
     *
     * @return bool
     */
    public function getIsEncrypted()
    {
        return $this->_isEncrypted;
    }

    /**
     * Set "Is encrypted"
     *
     * @param bool $value Is encrypted
     *
     * @return none
     */
    public function setIsEncrypted($value)
    {
        $this->_isEncrypted = $value;
    }

    /**
     * Get "Encryption scheme"
     *
     * @return string
     */
    public function getEncryptionScheme()
    {
        return $this->_encryptionScheme;
    }

    /**
     * Set "Encryption scheme"
     *
     * @param string $value Encryption scheme
     *
     * @return none
     */
    public function setEncryptionScheme($value)
    {
        $this->_encryptionScheme = $value;
    }

    /**
     * Get "Encryption version"
     *
     * @return string
     */
    public function getEncryptionVersion()
    {
        return $this->_encryptionVersion;
    }

    /**
     * Set "Encryption version"
     *
     * @param string $value Encryption version
     *
     * @return none
     */
    public function setEncryptionVersion($value)
    {
        $this->_encryptionVersion = $value;
    }

    /**
     * Get "Parent asset id"
     *
     * @return string
     */
    public function getParentAssetId()
    {
        return $this->_parentAssetId;
    }

    /**
     * Set "Parent asset id"
     *
     * @param string $value Parent asset id
     *
     * @return none
     */
    public function setParentAssetId($value)
    {
        $this->_parentAssetId = $value;
    }

    /**
     * Get "Content file size"
     *
     * @return int
     */
    public function getContentFileSize()
    {
        return $this->_contentFileSize;
    }

    /**
     * Set "Content file size"
     *
     * @param int $value Content file size
     *
     * @return none
     */
    public function setContentFileSize($value)
    {
        $this->_contentFileSize = $value;
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
     * Get "Asset file Id"
     *
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }
}


