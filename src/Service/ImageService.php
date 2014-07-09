<?php
namespace HtImgModule\Service;

use Imagine\Image\ImagineInterface;
use HtImgModule\Options\CacheOptionsInterface;
use HtImgModule\Imagine\Filter\FilterManagerInterface;
use HtImgModule\Imagine\Loader\LoaderManagerInterface;
use HtImgModule\EventManager\EventProvider;

class ImageService extends EventProvider implements ImageServiceInterface
{
    /**
     * @var CacheOptionsInterface
     */
    protected $cacheOptions;

    /**
     * @var CacheManagerInterface
     */
    protected $cacheManager;

    /**
     * @var ImagineInterface
     */
    protected $imagine;

    /**
     * @var FilterManagerInterface
     */
    protected $filterManager;

    /**
     * @var LoaderManagerInterface
     */
    protected $loaderManager;

    /**
     * Constructor
     *
     * @param CacheOptionsInterface  $cacheOptions
     * @param ImagineInterface       $imagine
     * @param FilterManagerInterface $filterManager
     * @param LoaderManagerInterface $loaderManager
     */
    public function __construct(
        CacheOptionsInterface $cacheOptions,
        ImagineInterface $imagine,
        FilterManagerInterface $filterManager,
        LoaderManagerInterface $loaderManager
    )
    {
        $this->cacheOptions = $cacheOptions;
        $this->imagine = $imagine;
        $this->filterManager = $filterManager;
        $this->loaderManager = $loaderManager;
    }

    /**
     * Sets cache manager
     *
     * @param CacheManagerInterface $cacheManager
     */
    public function setCacheManager(CacheManagerInterface $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    /**
     * {@inheritDoc}
     */
    public function getImage($relativePath, $filter)
    {
        $eventManager = $this->getEventManager();
        $eventManager->trigger(__FUNCTION__, $this, ['relativePath' => $relativePath, 'filter' => $filter]);

        $filterOptions = $this->filterManager->getFilterOptions($filter);

        if (isset($filterOptions['format'])) {
            $format = $filterOptions['format'];
        } else {
            $binary = $this->loaderManager->loadBinary($relativePath, $filter);
            $format = $binary->getFormat() ?: 'png';
        }

        if ($this->cacheOptions->getEnableCache() && $this->cacheManager->cacheExists($relativePath, $filter, $format)) {
            $imagePath      = $this->cacheManager->getCachePath($relativePath, $filter, $format);
            $filteredImage  = $this->imagine->open($imagePath);
        } else {
            if (!isset($binary)) {
                $binary = $this->loaderManager->loadBinary($relativePath, $filter);
            }

            $image          = $this->imagine->load($binary->getContent());
            $filteredImage  = $this->filterManager->getFilter($filter)->apply($image);

            if ($this->cacheOptions->getEnableCache()) {
                $this->cacheManager->createCache($relativePath, $filter, $filteredImage, $format);
            }
        }

        $args = ['relativePath' => $relativePath, 'filter' => $filter, 'filteredImage' => $filteredImage, 'format' => $format];
        $eventManager->trigger(__FUNCTION__ . '.post', $this, $args);

        return [
            'image'  => $filteredImage,
            'format' => $format
        ];

    }
}
