<?php
namespace TeamNeusta\WindowsAzureCurl\Model\Media;
use TeamNeusta\WindowsAzureCurl\Filter\Edm;
use TeamNeusta\WindowsAzureCurl\Model\AbstractModel;
use TeamNeusta\WindowsAzureCurl\Model\General\ModelInterface;


class File extends AbstractModel implements ModelInterface
{

    /**
     * id
     *
     * @var
     */
    protected $id;
    /**
     * name
     *
     * @var
     */
    protected $name;
    /**
     * contentFileSize
     *
     * @var
     */
    protected $contentFileSize;
    /**
     * parentAssetId
     *
     * @var
     */
    protected $parentAssetId;
    /**
     * encryptionVersion
     *
     * @var
     */
    protected $encryptionVersion;
    /**
     * encryptionScheme
     *
     * @var
     */
    protected $encryptionScheme;
    /**
     * isEncrypted
     *
     * @var
     */
    protected $isEncrypted;
    /**
     * encryptionKeyId
     *
     * @var
     */
    protected $encryptionKeyId;
    /**
     * initializationVector
     *
     * @var
     */
    protected $initializationVector;
    /**
     * isPrimary
     *
     * @var
     */
    protected $isPrimary;
    /**
     * lastModified
     *
     * @var
     */
    protected $lastModified;
    /**
     * created
     *
     * @var
     */
    protected $created;
    /**
     * mimeType
     *
     * @var
     */
    protected $mimeType;
    /**
     * contentChecksum
     *
     * @var
     */
    protected $contentChecksum;
    /**
     * options
     *
     * @var
     */
    protected $options;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getContentFileSize()
    {
        return $this->contentFileSize;
    }

    /**
     * @param mixed $contentFileSize
     */
    public function setContentFileSize($contentFileSize)
    {
        $this->contentFileSize = $contentFileSize;
    }

    /**
     * @return mixed
     */
    public function getParentAssetId()
    {
        return $this->parentAssetId;
    }

    /**
     * @param mixed $parentAssetId
     */
    public function setParentAssetId($parentAssetId)
    {
        $this->parentAssetId = $parentAssetId;
    }

    /**
     * @return mixed
     */
    public function getEncryptionVersion()
    {
        return $this->encryptionVersion;
    }

    /**
     * @param mixed $encryptionVersion
     */
    public function setEncryptionVersion($encryptionVersion)
    {
        $this->encryptionVersion = $encryptionVersion;
    }

    /**
     * @return mixed
     */
    public function getEncryptionScheme()
    {
        return $this->encryptionScheme;
    }

    /**
     * @param mixed $encryptionScheme
     */
    public function setEncryptionScheme($encryptionScheme)
    {
        $this->encryptionScheme = $encryptionScheme;
    }

    /**
     * @return mixed
     */
    public function getIsEncrypted()
    {
        return $this->isEncrypted;
    }

    /**
     * @param mixed $isEncrypted
     */
    public function setIsEncrypted($isEncrypted)
    {
        $this->isEncrypted = $isEncrypted;
    }

    /**
     * @return mixed
     */
    public function getEncryptionKeyId()
    {
        return $this->encryptionKeyId;
    }

    /**
     * @param mixed $encryptionKeyId
     */
    public function setEncryptionKeyId($encryptionKeyId)
    {
        $this->encryptionKeyId = $encryptionKeyId;
    }

    /**
     * @return mixed
     */
    public function getInitializationVector()
    {
        return $this->initializationVector;
    }

    /**
     * @param mixed $initializationVector
     */
    public function setInitializationVector($initializationVector)
    {
        $this->initializationVector = $initializationVector;
    }

    /**
     * @return mixed
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * @param mixed $isPrimary
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;
    }

    /**
     * @return mixed
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @param mixed $lastModified
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param mixed $mimeType
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @return mixed
     */
    public function getContentChecksum()
    {
        return $this->contentChecksum;
    }

    /**
     * @param mixed $contentChecksum
     */
    public function setContentChecksum($contentChecksum)
    {
        $this->contentChecksum = $contentChecksum;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }
}


