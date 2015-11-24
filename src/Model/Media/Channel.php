<?php
/***************************************************************
 *  (c) 2015 Benjamin Kluge <b.kluge@neusta.de>, NEUSTA GmbH
 *  All rights reserved
 ***************************************************************/
namespace TeamNeusta\WindowsAzureCurl\Model\Media;

use TeamNeusta\WindowsAzureCurl\Model\AbstractModel;
use TeamNeusta\WindowsAzureCurl\Model\General\ModelInterface;

class Channel extends AbstractModel implements ModelInterface
{
    /**
     * id
     *
     * @var int
     */
    protected $id;

    /**
     * name
     *
     * @var string
     */
    protected $name;

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
     * lastModified
     *
     * @var \DateTime
     */
    protected $lastModified;

    /**
     * state
     *
     * @var string
     */
    protected $state;
    /**
     * encodingType
     *
     * @var string
     */
    protected $encodingType;
    /**
     * input
     *
     * @var ChannelInput
     */
    protected $input;

    /**
     * encoding
     *
     * @var Encoding
     */
    protected $encoding;

    /**
     * @return Encoding
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @param Encoding $encoding
     */
    public function setEncoding($encoding)
    {
        if(is_array($encoding)) {
            $this->encoding = Encoding::createFromOptions($encoding);
        } else {
            $this->encoding = $encoding;
        }
    }

    /**
     * @return ChannelInput
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @param ChannelInput $input
     */
    public function setInput($input)
    {
        if(is_array($input)) {
            $this->input = ChannelInput::createFromOptions($input);
        } else {
            $this->input = $input;
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
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
    public function getEncodingType()
    {
        return $this->encodingType;
    }

    /**
     * @param string $encodingType
     */
    public function setEncodingType($encodingType)
    {
        $this->encodingType = $encodingType;
    }
}