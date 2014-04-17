<?php
namespace HtImgModule\Service;

interface ImageServiceInterface
{
    /**
     * Gets image from relative path of image
     *
     * @param  string                        $relativePath
     * @param  string                        $filter
     * @throws \HtImgModule\Exception\ImageNotFoundException
     * @return array
     */
    public function getImageFromRelativePath($relativePath, $filter);
    
    /**
     * Gets image from path of image
     *
     * @param  string                        $imagePath
     * @param  string                        $filter
     * @return \Imagine\Image\ImageInterface
     */
    public function getImage($imagePath, $filter);        
}
