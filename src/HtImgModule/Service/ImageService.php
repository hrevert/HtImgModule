<?php
namespace HtImgModule\Service;

use Imagine\Image\ImagineInterface;

class ImageService
{
    /**
     * Constructor
     * @param ImagineInterface $imagine
     */
    public function __construct(ImagineInterface $imagine)
    {
        $this->imagine = $imagine;
    }

    public function getImage($relativePath, $filter)
    {
        
    }
}