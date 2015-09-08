<?php
namespace Bennsel\WindowsAzureCurl\Model\Media;
use Bennsel\WindowsAzureCurl\Model\AbstractModel;


/**
 * Represents task object used in media services
 *
 * @category  Microsoft
 * @package   WindowsAzure\MediaServices\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: 0.4.0_2014-01
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
class Task extends AbstractModel
{
    /**
     * The state of the task "none"
     *
     * @var int
     */
    const STATE_NONE = 0;

    /**
     * The state of the task "active"
     *
     * @var int
     */
    const STATE_ACTIVE = 1;

    /**
     * The state of the task "running"
     *
     * @var int
     */
    const STATE_RUNNING = 2;

    /**
     * The state of the task "completed"
     *
     * @var int
     */
    const STATE_COMPLETED = 3;

    /**
     * Task id
     *
     * @var string
     */
    private $_id;

    /**
     * Configuration
     *
     * @var string
     */
    private $_configuration;

    /**
     * End tine
     *
     * @var \DateTime
     */
    private $_endTime;

    /**
     * Media procesot id
     *
     * @var string
     */
    private $_mediaProcessorId;

    /**
     * Perfoemance message
     *
     * @var string
     */
    private $_perfMessage;

    /**
     * Progress
     *
     * @var double
     */
    private $_progress;

    /**
     * Running duration
     *
     * @var double
     */
    private $_runningDuration;

    /**
     * Task body
     *
     * @var string
     */
    private $_taskBody;

    /**
     * Options
     *
     * @var int
     */
    private $_options;

    /**
     * Encription key id
     *
     * @var string
     */
    private $_encryptionKeyId;

    /**
     * Encryption scheme
     *
     * @var string
     */
    private $_encryptionScheme;

    /**
     * Encryption version
     *
     * @var string
     */
    private $_encryptionVersion;

    /**
     * Initialization vector
     *
     * @var string
     */
    private $_initializationVector;

    /**
     * State
     *
     * @var int
     */
    private $_state;

    /**
     * Name
     *
     * @var string
     */
    private $_name;

    /**
     * Priority
     *
     * @var int
     */
    private $_priority;

    /**
     * Start time
     *
     * @var \DateTime
     */
    private $_startTime;

    /**
     * HistoricalEvents
     *
     * @var array
     */
    private $_historicalEvents;

    /**
     * ErrorDetails
     *
     * @var array
     */
    private $_errorDetails;

    /**
     * Create task from array
     *
     * @param array $options Array containing values for object properties
     *
     * @return Task
     */
    public static function createFromOptions($options)
    {
        $task = new Task(
            $options['TaskBody'],
            $options['MediaProcessorId'],
            $options['Options']
        );
        $task->fromArray($options);

        return $task;
    }

    /**
     * Create task
     *
     * @param string $taskBody         Task body.
     * @param string $mediaProcessorId Media processor identifier.
     * @param int    $options          Task encryption options.
     */
    public function __construct($taskBody, $mediaProcessorId, $options)
    {
        $this->_taskBody         = $taskBody;
        $this->_options          = $options;
        $this->_mediaProcessorId = $mediaProcessorId;
    }

    /**
     * Fill task from array
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

        if (isset($options['Configuration'])) {
            $this->_configuration = $options['Configuration'];
        }

        if (isset($options['EndTime'])) {
            $this->_endTime = new \DateTime($options['EndTime']);
        }

        if (isset($options['MediaProcessorId'])) {
            $this->_mediaProcessorId = $options['MediaProcessorId'];
        }

        if (isset($options['Name'])) {
            $this->_name = $options['Name'];
        }

        if (isset($options['PerfMessage'])) {
            $this->_perfMessage = $options['PerfMessage'];
        }

        if (isset($options['Priority'])) {
            $this->_priority = $options['Priority'];
        }

        if (isset($options['Progress'])) {
            $this->_progress = $options['Progress'];
        }

        if (isset($options['RunningDuration'])) {
            $this->_runningDuration = $options['RunningDuration'];
        }

        if (isset($options['StartTime'])) {
            $this->_startTime = new \DateTime($options['StartTime']);
        }

        if (isset($options['State'])) {
            $this->_state = $options['State'];
        }

        if (isset($options['TaskBody'])) {
            $this->_taskBody = $options['TaskBody'];
        }

        if (isset($options['Options'])) {
            $this->_options = $options['Options'];
        }

        if (isset($options['EncryptionKeyId'])) {
            $this->_encryptionKeyId = $options['EncryptionKeyId'];
        }

        if (isset($options['EncryptionScheme'])) {
            $this->_encryptionScheme = $options['EncryptionScheme'];
        }

        if (isset($options['EncryptionVersion'])) {
            $this->_encryptionVersion = $options['EncryptionVersion'];
        }

        if (isset($options['InitializationVector'])) {
            $this->_initializationVector = $options['InitializationVector'];
        }

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
     * Get "State"
     *
     * @return int
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Get "Task id"
     *
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Get "Start time"
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->_startTime;
    }

    /**
     * Get "Running duration"
     *
     * @return double
     */
    public function getRunningDuration()
    {
        return $this->_runningDuration;
    }

    /**
     * Get "Priority"
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->_priority;
    }

    /**
     * Set "Priority"
     *
     * @param int $value Priority
     *
     * @return none
     */
    public function setPriority($value)
    {
        $this->_priority = $value;
    }

    /**
     * Get "End time"
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->_endTime;
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
     * Get "Encription key id"
     *
     * @return string
     */
    public function getEncryptionKeyId()
    {
        return $this->_encryptionKeyId;
    }

    /**
     * Set "Encription key id"
     *
     * @param string $value Encription key id
     *
     * @return none
     */
    public function setEncryptionKeyId($value)
    {
        $this->_encryptionKeyId = $value;
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
     * Get "Task body"
     *
     * @return string
     */
    public function getTaskBody()
    {
        return $this->_taskBody;
    }

    /**
     * Set "Task body"
     *
     * @param string $value Task body
     *
     * @return none
     */
    public function setTaskBody($value)
    {
        $this->_taskBody = $value;
    }

    /**
     * Get "Progress"
     *
     * @return double
     */
    public function getProgress()
    {
        return $this->_progress;
    }

    /**
     * Get "Perfoemance message"
     *
     * @return string
     */
    public function getPerfMessage()
    {
        return $this->_perfMessage;
    }

    /**
     * Get "Media procesot id"
     *
     * @return string
     */
    public function getMediaProcessorId()
    {
        return $this->_mediaProcessorId;
    }

    /**
     * Set "Media procesot id"
     *
     * @param string $value Media procesot id
     *
     * @return none
     */
    public function setMediaProcessorId($value)
    {
        $this->_mediaProcessorId = $value;
    }

    /**
     * Get "Configuration"
     *
     * @return string
     */
    public function getConfiguration()
    {
        return $this->_configuration;
    }

    /**
     * Set "Configuration"
     *
     * @param string $value Configuration
     *
     * @return none
     */
    public function setConfiguration($value)
    {
        $this->_configuration = $value;
    }

    /**
     * Get "ErrorDetails"
     *
     * @return array
     */
    public function getErrorDetails()
    {
        return $this->_errorDetails;
    }

    /**
     * Get "HistoricalEvents"
     *
     * @return array
     */
    public function getHistoricalEvents()
    {
        return $this->_historicalEvents;
    }
}

