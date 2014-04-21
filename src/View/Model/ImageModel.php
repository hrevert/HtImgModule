<?php
namespace HtImgModule\View\Model;

use Zend\View\Model\ViewModel;
use Imagine\Image\ImageInterface;
use HtImgModule\Exception;

class ImageModel extends ViewModel
{
    /**
     * Image won't need to be captured into a
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
    protected $format = 'png';

    /**
     * Constructor
     *
     * @param ImageInterface|string $imageOrPath
     * @param string|null           $format
     */
    public function __construct($imageOrPath = null, $format = null)
    {
        if ($imageOrPath !== null) {
            if (is_string($imageOrPath)) {
                $this->setImagePath($imageOrPath);
            } elseif ($imageOrPath instanceof ImageInterface) {
                $this->setImage($imageOrPath);
            } else {
                throw new Exception\InvalidArgumentException(
                    sprintf(
                        '%s expects parameter 1 to be image path or instance of Imagine\Image\ImageInterface, %s provided instead',
                        __METHOD__,
                        is_object($imageOrPath) ? get_class($imageOrPath) : gettype($imageOrPath)
                    )
                );
            }
        }
        if ($format !== null) {
            $this->setFormat($format);
        }
    }

    /**
     * Sets path of image to show
     *
     * @param  string $imagePath
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
     * @param  ImageInterface $image
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
     * @param  string $format
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
