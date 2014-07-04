<?php

/**
 * HtImgModule Configuration
 *
 * If you have a ./config/autoload/ directory set up for your project, you can
 * drop this config file in it and change the values as you wish.
 */

$options = [
    /**
     * Enable Cache
     *
     * Whether or not to cache image in public path,
     * so that Apache(or whatever) can directly get image
     * This can improve a lot of performance
     *
     * Default: true
     * Accepted values: boolean
     */
    // 'enable_cache' => true,

    /**
     * Image Source Path Stack
     *
     * Folders where to look for the requested file (similiar to Zend Framework 2 template path stack)
     *
     * Default: Empty array|array()
     * Accepted values: array containing folders or directories
     */
    //'img_source_path_stack' => ['data/images/'],

    /**
     * Image Source Map
     *
     * Exact path to image (similiar to Zend Framework 2 template map)
     *
     * Default: Empty array|array()
     * Accepted values: array containing key as image relative path and value as image real path
     */
    //'img_source_map' => array('hello/world.png' => 'data/img/hello/world.png'),

    /**
     * Imagine Driver
     *
     * Default: gd
     * Accepted values: one of gd, imagick or gmagick
     * It is registered as service which you can obtain throught ServiceLocator aware classes with:
     * $imagine = $this->getServiceLocator()->get('HtImg\Imagine');
     */
    //'driver' => 'gd',

     /**
      * Filters which can be accessed through view helper, 'imgUrl' easily
      */
    //'filters' => [],

     /**
      * Web Root
      *
      * Default: public (For Zend Skeleton Application)
      */
    //'web_root' => 'public_html',

     /**
      * Cache Path(Relative to web root)
      *
      * Default: htimg
      */
    //'cache_path' => 'htimg'

    /**
     * Filter Loaders
     */
    //'filter_loaders' => [],

    /**
     * Cache Expiry
     *
     * Interval in seconds after which a cached image will expire and new cache is to be created
     *
     * Default: 86400   (1 day)
     * Accepted value: Integer
     */
    //'cache_expiry' => 86400

    /**
     * Default Image Loader
     *
     * Image Loader determines how to load a image for a "filter"
     * This option means the default image loader(for all filters)
     * Please see the docs for creating a custom image loader
     */
    // 'default_image_loader' => 'FileSystem',
];

/**
 * You do not need to edit below this line
 */
return [
    'htimg' => $options
];
