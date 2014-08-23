<?php
namespace HtImgModule\View\Renderer;

use Zend\View\Renderer\RendererInterface;
use Zend\View\Resolver\ResolverInterface;
use HtImgModule\View\Model\ImageModel;
use HtImgModule\Exception;
use Imagine\Image\ImageInterface;

class ImageRenderer implements RendererInterface
{
    /**
     * Return the template engine object, if any
     *
     * If using a third-party template engine, such as Smarty, patTemplate,
     * phplib, etc, return the template engine object. Useful for calling
     * methods on these objects, such as for setting filters, modifiers, etc.
     *
     * @return mixed
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * Set the resolver used to map a template name to a resource the renderer may consume.
     *
     * @param  ResolverInterface $resolver
     * @return Renderer
     */
    public function setResolver(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;

        return $this;
    }

    public function render($nameOrModel, $values = null)
    {
        if ($nameOrModel instanceof ImageModel) {
            $imageModel = $nameOrModel;
            $image = $imageModel->getImage();
            $format = $imageModel->getFormat();
            if (!$imageModel->getImage() instanceof ImageInterface) {
                throw new Exception\RuntimeException(
                    'You must provide Imagine\Image\ImageInterface or path of image'
                );
            }

            return $image->get($format);
        }

        throw new Exception\InvalidArgumentException(sprintf(
            '%s expects argument 1 to be an instance of HtImgModule\View\Model\ImageModel, %s provided instead',
            __METHOD__,
            is_object($nameOrModel) ? get_class($nameOrModel) : gettype($nameOrModel)
        ));
    }
}
