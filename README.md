HtImgModule
===========

This module simplies image manipulation for Zend Framework 2. This module integrates Zend Framework 2 with [Imagine](https://github.com/avalanche123/Imagine), the most amazing Image manipulation library for PHP.

## Installation
* Add `hrevert/ht-img-module: "dev-master"` to compose.json and run `php comopse.phar update`
* Register `HtImgModule` as module in `config/application.config.php`
* Copy the file located in `vendor/hrevert/ht-img-module/config/ht-img-module.global.php` to `config/autoload` and change the values as you wish

## Basic Usage
First, you need to create a filter alias, `my_thumbnail` in `/module/Application/config/module.config.php`
```php
return [
    'htimg' => [
        'filters' => [
            'my_thumbnail' => [ // this is filter aliases
                'type' => 'thumbnail', // this is a filter loader
                'options' => [  // filter loader passes these options to a Filter which manipulates the image
                    'width' => 100,
                    'height' => 100,
                    'format' => 'jpeg' // format is optional and defaults to the format of given image
                ]
            ]        
        ]
    ]
];
```

Now, you can get image from view templates like:
```
<img src="<?php echo $this->htImgUrl('my_image.png', 'my_thumbnail'); ?>" alt="Hello" />
```
Alternatively, you can:
```php
  <?php echo $this->htDisplayImage('my_image.png', 'my_thumbnail', ['alt' => 'Hello']); ?>
```
Behind the scenes, the module applies the filter to the image on the first request and then caches the image to the web root. On the next request, the cached image would be served directly from the file system.

## Theory of Operation
Whenever, you call a filter alias like `my_thumbnail` from view template, the view helpers(htImgUrl and htDisplayImage) check if the cached image exists. If the cached image exists, it just returns the url to cached image. Else, it passes a url of route `htimg/:filter/:relativePath`. On that route, image resolver resolves the actual path of image. Now, filter loader loads a [filter](http://imagine.readthedocs.org/en/latest/usage/filters.html) by passing options specified in the config and the [filter](http://imagine.readthedocs.org/en/latest/usage/filters.html) manipulates the image. Also a new cached image is created in the web root!


