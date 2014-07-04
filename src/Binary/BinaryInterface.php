<?php
namespace HtImgModule\Binary;

interface BinaryInterface
{
    /**
     * Gets binary content
     *
     * @return string
     */
    public function getContent();

    /**
     * Gets mime type
     *
     * @return string
     */
    public function getMimeType();

    /**
     * Sets format
     *
     * @param  string $format
     * @return void
     */
    public function setFormat($format);

    /**
     * Gets format
     *
     * @return string
     */
    public function getFormat();
}
