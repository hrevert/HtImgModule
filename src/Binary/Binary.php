<?php
namespace HtImgModule\Binary;

class Binary implements BinaryInterface
{
    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $mimeType;

    /**
     * @var string
     */
    protected $format;

    /**
     * Constructor
     *
     * @param string      $content
     * @param string      $mimeType
     * @param string|null $format
     */
    public function __construct($content, $mimeType, $format = null)
    {
        $this->content  = $content;
        $this->mimeType = $mimeType;
        $this->format   = $format;
    }

    /**
     * {@inheritDoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritDoc}
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * {@inheritDoc}
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * {@inheritDoc}
     */
    public function getFormat()
    {
        return $this->format;
    }
}
