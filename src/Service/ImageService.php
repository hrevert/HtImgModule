<?php
namespace HtImgModule\Service;

use Imagine\Image\ImagineInterface;
use HtImgModule\Imagine\Filter\FilterManagerInterface;
use HtImgModule\Imagine\Loader\LoaderManagerInterface;
use HtImgModule\EventManager\EventProvider;

class ImageService extends EventProvider implements ImageServiceInterface
{
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
     * @param CacheManagerInterface  $cacheManager
     * @param ImagineInterface       $imagine
     * @param FilterManagerInterface $filterManager
     * @param LoaderManagerInterface $loaderManager
     */
    public function __construct(
        CacheManagerInterface  $cacheManager,
        ImagineInterface $imagine,
        FilterManagerInterface $filterManager,
        LoaderManagerInterface $loaderManager
    )
    {
        $this->cacheManager  = $cacheManager;
        $this->imagine       = $imagine;
        $this->filterManager = $filterManager;
        $this->loaderManager = $loaderManager;
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

        if ($this->cacheManager->isCachingEnabled($filter, $filterOptions) && $this->cacheManager->cacheExists($relativePath, $filter, $format)) {
            $imagePath      = $this->cacheManager->getCachePath($relativePath, $filter, $format);
            $filteredImage  = $this->imagine->open($imagePath);
        } else {
            if (!isset($binary)) {
                $binary = $this->loaderManager->loadBinary($relativePath, $filter);
            }

            $image          = $this->imagine->load($binary->getContent());
            $filteredImage  = $this->filterManager->getFilter($filter)->apply($image);

            if ($this->cacheManager->isCachingEnabled($filter, $filterOptions)) {
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
