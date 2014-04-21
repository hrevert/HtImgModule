<?php
namespace HtImgModule\Imagine\Filter;

use Imagine\Image\ImageInterface;
use Imagine\Image\Box;
use Imagine\Image\Point;
use HtImgModule\Exception;

class Watermark implements \Imagine\Filter\FilterInterface
{
    /**
     * @var string|int|null
     */
    protected $size;

    /**
     * @var string
     */
    protected $position;

    /**
     * @var ImageInterface
     */
    protected $watermark;

    /**
     * Constructor
     *
     * @param ImageInterface  $watermark
     * @param string|int|null $size
     * @param string          $position
     */
    public function __construct(ImageInterface $watermark, $size = null, $position = 'center')
    {
        $this->watermark = $watermark;
        $this->position = $position;
        if (!is_null($size)) {
            if (is_string($size) && substr($size, -1) === '%') {
                $size = substr($size, 0, -1) / 100;
            }
            if (!is_integer($size) && !is_double($size) && !is_float($size)) {
                throw new Exception\InvalidArgumentException(
                    sprintf('"%s" expects parameter 2, size to be integer, %s provider instead', __METHOD__, gettype($size))
                );
            }
            $this->size = $size;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function apply(ImageInterface $image)
    {
        $watermark = $this->watermark;

        $size = $image->getSize();
        $watermarkSize = $watermark->getSize();

        // If 'null': Downscale if needed
        if (!$this->size && ($size->getWidth() < $watermarkSize->getWidth() || $size->getHeight() < $watermarkSize->getHeight())) {
            $this->size = 1.0;
        }

        if ($this->size) {
            $factor = $this->size * min($size->getWidth() / $watermarkSize->getWidth(), $size->getHeight() / $watermarkSize->getHeight());

            $watermark->resize(new Box($watermarkSize->getWidth() * $factor, $watermarkSize->getHeight() * $factor));
            $watermarkSize = $watermark->getSize();
        }

        switch ($this->position) {
            case 'topleft':
                $x = 0;
                $y = 0;
                break;
            case 'top':
                $x = ($size->getWidth() - $watermarkSize->getWidth()) / 2;
                $y = 0;
                break;
            case 'topright':
                $x = $size->getWidth() - $watermarkSize->getWidth();
                $y = 0;
                break;
            case 'left':
                $x = 0;
                $y = ($size->getHeight() - $watermarkSize->getHeight()) / 2;
                break;
            case 'center':
                $x = ($size->getWidth() - $watermarkSize->getWidth()) / 2;
                $y = ($size->getHeight() - $watermarkSize->getHeight()) / 2;
                break;
            case 'right':
                $x = $size->getWidth() - $watermarkSize->getWidth();
                $y = ($size->getHeight() - $watermarkSize->getHeight()) / 2;
                break;
            case 'bottomleft':
                $x = 0;
                $y = $size->getHeight() - $watermarkSize->getHeight();
                break;
            case 'bottom':
                $x = ($size->getWidth() - $watermarkSize->getWidth()) / 2;
                $y = $size->getHeight() - $watermarkSize->getHeight();
                break;
            case 'bottomright':
                $x = $size->getWidth() - $watermarkSize->getWidth();
                $y = $size->getHeight() - $watermarkSize->getHeight();
                break;
            default:
                throw new Exception\InvalidArgumentException(
                    sprintf('Unknown position "%s"', $this->position)
                );
        }

        return $image->paste($watermark, new Point($x, $y));
    }
}
