<?php
namespace HtImgModule\Imagine\Filter;

use Imagine\Filter\FilterInterface;
use Imagine\Image\ImageInterface;
use Imagine\Image\ImagineInterface;
use Imagine\Image\Box;
use Imagine\Image\Point;

class Background implements FilterInterface
{
    /**
     * @var ImagineInterface
     */
    protected $imagine;

    /**
     * @var array|int[]
     */
    protected $size;

    /**
     * @var string
     */
    protected $color;

    /**
     * Constructor
     *
     * @param ImagineInterface $imagine
     * @param array|int[]      $size
     * @param string           $color
     */
    public function __construct(ImagineInterface $imagine, $size = null, $color = '#fff')
    {
        $this->imagine  = $imagine;
        $this->size     = $size;
        $this->color    = $color;
    }

    /**
     * {@inheritDoc}
     */
    public function apply(ImageInterface $image)
    {
        if ($this->size) {
            list($width, $height) = $this->size;

            $size = new Box($width, $height);
            $topLeft = new Point(
                ($width - $image->getSize()->getWidth()) / 2,
                ($height - $image->getSize()->getHeight()) / 2
            );
        } else {
            $topLeft = new Point(0, 0);
            $size = $image->getSize();
        }

        $background = $image->palette()->color($this->color);
        $canvas = $this->imagine->create($size, $background);

        return $canvas->paste($image, $topLeft);
    }
}
