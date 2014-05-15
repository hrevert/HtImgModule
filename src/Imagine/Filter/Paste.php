<?php
namespace HtImgModule\Imagine\Filter;

use Imagine\Filter\FilterInterface;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point;
use HtImgModule\Exception;

class Paste implements FilterInterface
{
    /**
     * @var \Imagine\Image\ImageInterface
     */
    protected $pasteImage;

    /**
     * @var string|integer
     */
    protected $x;

    /**
     * @var string|integer
     */
    protected $y;

    /**
     * @param \Imagine\Image\ImageInterface $pasteImage Image to be pasted
     * @param string|int                    $x          x-coordinage|position of left corner
     * @param string|int                    $y          y-coordinage|position of left corner
     */
    public function __construct(ImageInterface $pasteImage, $x, $y)
    {
        $this->throwIfPointNotValid($x, 'x', ['left', 'right', 'center']);
        $this->throwIfPointNotValid($y, 'y', ['top', 'bottom', 'middle']);

        $this->pasteImage = $pasteImage;
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * {@inheritDoc}
     */
    public function apply(ImageInterface $image)
    {
        $x = is_string($this->x)
            ? $this->stringXtoInteger($this->x, $this->pasteImage, $image)
            : $this->x
        ;

        $y = is_string($this->y)
            ? $this->stringYtoInteger($this->y, $this->pasteImage, $image)
            : $this->y
        ;

        return $image->paste($this->pasteImage, new Point($x, $y));
    }

    /**
     * @param string                        $point
     * @param \Imagine\Image\ImageInterface $pasteImage
     * @param \Imagine\Image\ImageInterface $image
     *
     * @return integer
     */
    protected function stringXtoInteger($point, ImageInterface $pasteImage, ImageInterface $image)
    {
        switch ($point) {
            case 'right':
                return (integer) $image->getSize()->getWidth() - $pasteImage->getSize()->getWidth();
            case 'center':
                return (integer) round( ($image->getSize()->getWidth() / 2) - ($pasteImage->getSize()->getWidth() / 2) );
            case 'left':
        }
    }

    /**
     * @param string                        $point
     * @param \Imagine\Image\ImageInterface $pasteImage
     * @param \Imagine\Image\ImageInterface $image
     *
     * @return integer
     */
    protected function stringYtoInteger($point, ImageInterface $pasteImage, ImageInterface $image)
    {
        switch ($point) {
            case 'bottom':
                return (integer) $image->getSize()->getHeight() - $pasteImage->getSize()->getHeight();
            case 'middle':
                return (integer) round( ($image->getSize()->getHeight() / 2) - ($pasteImage->getSize()->getHeight() / 2) );
            case 'top':
        }
    }

    /**
     * @param integer|string $point
     * @param string         $pointName
     * @param array          $allowedStringValues
     *
     * @throws \InvalidArgumentException
     */
    protected function throwIfPointNotValid($point, $pointName, array $allowedStringValues)
    {
        if (is_string($point) && in_array($point, $allowedStringValues)) {
            return;
        }

        if (is_integer($point) && $point >= 0) {
            return;
        }

        throw new Exception\InvalidArgumentException(sprintf(
            'Expected "%s" one of the [%s] or integer greater than zero',
            $pointName,
            implode('|', $allowedStringValues)
        ));
    }
}
