<?php
namespace HtImgModule\Binary;

interface BinaryInterface
{
    /**
     * @return string
     */
    public function getContent();
    
    /**
     * @return string
     */
    public function getMimeType();

    public function setFormat($format);
    
    /**
     * @return string
     */
    public function getFormat();            
}
