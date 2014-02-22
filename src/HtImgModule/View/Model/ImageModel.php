<?php
namespace HtImgModule\View\Model;

use Zend\View\Model\ViewModel;

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
     * @var 
     */
    protected $image; 

    public function __construct($imageOrPath = null)
    {
        if ($imageOrPath !== null) {
            if (is_string($imageOrPath)) {
                $this->setImagePath($imageOrPath);
            } else {
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
     * @param $image
     * @return self
     */    
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Gets image
     *
     * @return 
     */   
    public function getImage()
    {
        return $this->image;
    }            
}
