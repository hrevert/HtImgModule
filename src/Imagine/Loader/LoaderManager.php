<?php
namespace HtImgModule\Imagine\Loader;

use HtImgModule\Binary\Binary;
use HtImgModule\Exception;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Filter\FilterManagerInterface;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeExtensionGuesser;
use HtImgModule\Binary\MimeTypeGuesser;

class LoaderManager implements LoaderManagerInterface
{
    protected $imageLoaders;

    protected $filterManager;

    protected $defaultImageLoader;

    protected $mimeTypeGuesser;

    protected $extensionGuesser;

    public function __construct(
        ServiceLocatorInterface $imageLoaders, 
        FilterManagerInterface $filterManager, 
        $defaultImageLoader,
        MimeTypeGuesser $mimeTypeGuesser
    )
    {
        $this->imageLoaders = $imageLoaders;
        $this->filterManager = $filterManager;
        $this->defaultImageLoader = $defaultImageLoader;
        $this->mimeTypeGuesser = $mimeTypeGuesser;
    }

    public function getBinary($relativePath, $filter)
    {
        $filterOptions = $this->filterManager->getFilterOptions($filter);

        if (isset($filterOptions['image_loader'])) {
            $imageLoader = $filterOptions['image_loader'];
        } else {
            $imageLoader = $this->defaultImageLoader;
        }
        if (!is_object($imageLoader)) {
            $imageLoader = $this->imageLoaders->get($imageLoader);
        }
        
        $binary = $imageLoader->load($relativePath);
        if (!$binary) {
            throw new Exception\ImageNotFoundException();            
        }
        if (!$binary instanceof Binary) {
            $binary = new Binary($binary, $this->mimeTypeGuesser->guess($binary));
        }
        if ($binary->getFormat() === null) {
            $binary->setFormat($this->getExtensionGuesser()->guess($binary->getMimeType()));
        }

        return $binary;
    }

    public function getExtensionGuesser()
    {
        if (!$this->extensionGuesser) {
            $this->extensionGuesser = new MimeTypeExtensionGuesser();
        }

        return $this->extensionGuesser;
    }
}
