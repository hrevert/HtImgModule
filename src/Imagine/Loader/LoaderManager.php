<?php
namespace HtImgModule\Imagine\Loader;

use HtImgModule\Binary\Binary;
use HtImgModule\Binary\BinaryInterface;
use HtImgModule\Exception;
use Zend\ServiceManager\ServiceLocatorInterface;
use HtImgModule\Imagine\Filter\FilterManagerInterface;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeExtensionGuesser;
use HtImgModule\Binary\MimeTypeGuesser;

class LoaderManager implements LoaderManagerInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $imageLoaders;

    /**
     * @var FilterManagerInterface
     */
    protected $filterManager;

    /**
     * @var string
     */
    protected $defaultImageLoader;

    /**
     * @var MimeTypeGuesser
     */
    protected $mimeTypeGuesser;

    /**
     * @var MimeTypeExtensionGuesser
     */
    protected $extensionGuesser;

    /**
     * Constructor
     *
     * @param ServiceLocatorInterface $imageLoaders
     * @param FilterManagerInterface  $filterManager
     * @param string                  $defaultImageLoader
     * @param MimeTypeGuesser         $mimeTypeGuesser
     */
    public function __construct(
        ServiceLocatorInterface $imageLoaders,
        FilterManagerInterface $filterManager,
        $defaultImageLoader,
        MimeTypeGuesser $mimeTypeGuesser
    )
    {
        $this->imageLoaders       = $imageLoaders;
        $this->filterManager      = $filterManager;
        $this->defaultImageLoader = $defaultImageLoader;
        $this->mimeTypeGuesser    = $mimeTypeGuesser;
    }

    /**
     * {@inheritDoc}
     */
    public function loadBinary($relativePath, $filter)
    {
        $filterOptions = $this->filterManager->getFilterOptions($filter);

        if (isset($filterOptions['image_loader'])) {
            $imageLoader = $filterOptions['image_loader'];
        } else {
            $imageLoader = $this->defaultImageLoader;
        }
        if (!is_object($imageLoader)) {
            $imageLoader = $this->imageLoaders->get(
                $imageLoader,
                isset($filterOptions['loader_options']) ? $filterOptions['loader_options'] : []
            );
        }

        $binary = $imageLoader->load($relativePath);
        if (!$binary) {
            throw new Exception\ImageNotFoundException();
        }
        if (!$binary instanceof BinaryInterface) {
            $binary = new Binary($binary, $this->mimeTypeGuesser->guess($binary));
        }
        if ($binary->getFormat() === null) {
            $binary->setFormat($this->getExtensionGuesser()->guess($binary->getMimeType()));
        }

        return $binary;
    }

    /**
     * Gets a singleton mime type to file extension guesser.
     *
     * @return MimeTypeExtensionGuesser
     */
    public function getExtensionGuesser()
    {
        if (!$this->extensionGuesser) {
            $this->extensionGuesser = new MimeTypeExtensionGuesser();
        }

        return $this->extensionGuesser;
    }
}
