<?php
namespace TeamNeusta\WindowsAzureCurl\Model\Media;
use TeamNeusta\WindowsAzureCurl\Filter\Edm;
use TeamNeusta\WindowsAzureCurl\Model\AbstractModel;
use TeamNeusta\WindowsAzureCurl\Model\General\ModelInterface;


class Job extends AbstractModel implements ModelInterface
{
    private $id;
    private $name;
    private $created;
    private $lastModified;
    private $endTime;
    private $priority;
    private $runningDuration;
    private $startTime;
    private $state;
    private $templateId;
    private $inputMediaAssets;
    private $outputMediaAssets;
    private $tasks;
    private $jobNotificationSubscriptions;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Job
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return Job
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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
     * @return Job
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
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
     * @return Job
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     * @return Job
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $priority
     * @return Job
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRunningDuration()
    {
        return $this->runningDuration;
    }

    /**
     * @param mixed $runningDuration
     * @return Job
     */
    public function setRunningDuration($runningDuration)
    {
        $this->runningDuration = $runningDuration;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     * @return Job
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     * @return Job
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplateId()
    {
        return $this->templateId;
    }

    /**
     * @param mixed $templateId
     * @return Job
     */
    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInputMediaAssets()
    {
        return $this->inputMediaAssets;
    }

    /**
     * @param mixed $inputMediaAssets
     * @return Job
     */
    public function setInputMediaAssets($inputMediaAssets)
    {
        $this->inputMediaAssets = $inputMediaAssets;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOutputMediaAssets()
    {
        return $this->outputMediaAssets;
    }

    /**
     * @param mixed $outputMediaAssets
     * @return Job
     */
    public function setOutputMediaAssets($outputMediaAssets)
    {
        $this->outputMediaAssets = $outputMediaAssets;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param mixed $tasks
     * @return Job
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getJobNotificationSubscriptions()
    {
        return $this->jobNotificationSubscriptions;
    }

    /**
     * @param mixed $jobNotificationSubscriptions
     * @return Job
     */
    public function setJobNotificationSubscriptions($jobNotificationSubscriptions)
    {
        $this->jobNotificationSubscriptions = $jobNotificationSubscriptions;
        return $this;
    }
}


