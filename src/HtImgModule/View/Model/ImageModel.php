<?php
namespace HtImgModule\View\Model;

use Zend\View\Model\ViewModel;
use Imagine\Image\ImageInterface;

class ImageModel extends ViewModel
{
    /**
     * Image probably won't need to be captured into a 
     * a parent container by default.
     * 
     * @var string
     */
    protected $captureTo = null;

    /**
     * Image is terminal
     * 
     * @var bool
     */
    protected $terminate = true; 
    
    /**
     * Path of image to show
     *
     * @var string
     */
    protected $imagePath;

    /**
     * @var ImageInterface
     */
    protected $image; 

    /**
     * @var string
     */
    protected $format;

    /**
     * @var string
     */
    protected $template = 'ht-image/image';

    /**
     * Constructor
     *
     * @param ImageInterface|string $imageOrPath
     */
    public function __construct($imageOrPath = null)
    {
        if ($imageOrPath !== null) {
            if (is_string($imageOrPath)) {
                $this->setImagePath($imageOrPath);
            } elseif ($imageOrPath instanceof ImageInterface) {
                $this->setImage($imagePath);
            }
        }
    }
    
    /**
     * Sets path of image to show
     *
     * @param string $imagePath
     * @return self
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;

        return $this;
        
    }

    /**
     * Gets path of image to show
     *
     * @return string $fileName
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * Sets image
     *
     * @param ImageInterface $image
     * @return self
     */    
    public function setImage(ImageInterface $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Gets image
     *
     * @return ImageInterface
     */   
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets format
     *
     * @param string $format
     * @return self
     */     
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Gets format
     *
     * @return string
     */      
    public function getFormat()
    {
        return $this->format;
    }                
}
