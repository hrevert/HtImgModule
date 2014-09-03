HtImgModule
===========
[![Master Branch Build Status](https://api.travis-ci.org/hrevert/HtImgModule.png?branch=master)](http://travis-ci.org/hrevert/HtImgModule)
[![Latest Stable Version](https://poser.pugx.org/hrevert/ht-img-module/v/stable.png)](https://packagist.org/packages/hrevert/ht-img-module)
[![Latest Unstable Version](https://poser.pugx.org/hrevert/ht-img-module/v/unstable.png)](https://packagist.org/packages/hrevert/ht-img-module)
[![Total Downloads](https://poser.pugx.org/hrevert/ht-img-module/downloads.png)](https://packagist.org/packages/hrevert/ht-img-module)
[![Scrutinizer](https://scrutinizer-ci.com/g/hrevert/HtImgModule/badges/quality-score.png?s=c9bd5af136c2e580cf760d19f3ca72ae53bb8a02)](https://scrutinizer-ci.com/g/hrevert/HtImgModule/)
[![Code Coverage](https://scrutinizer-ci.com/g/hrevert/HtImgModule/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/hrevert/HtImgModule/?branch=master)

This module simplies image manipulation for Zend Framework 2. This module integrates Zend Framework 2 with [Imagine](https://github.com/avalanche123/Imagine), the most amazing Image manipulation library for PHP.

## Installation
* Add `"hrevert/ht-img-module": "0.3.*"` to composer.json and run `php composer.phar update`
* Register `HtImgModule` as module in `config/application.config.php`
* Copy the file located in `vendor/hrevert/ht-img-module/config/ht-img-module.global.php` to `config/autoload` and change the values as you wish

## Basic Usage
First, you need to create a filter service, `my_thumbnail` in `/module/Application/config/module.config.php`
```php
return [
    'htimg' => [
        'filters' => [
            'my_thumbnail' => [ // this is  filter service
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
```html+php
<img src="<?php echo $this->htImgUrl('my_image.png', 'my_thumbnail'); ?>" alt="Hello" />
```
Alternatively, you can:
```php
  <?php echo $this->htDisplayImage('my_image.png', 'my_thumbnail', ['alt' => 'Hello']); ?>
```
Behind the scenes, the module applies the filter to the image on the first request and then caches the image to the web root. On the next request, the cached image would be served directly from the file system.

## Theory of Operation
Whenever, you call a filter service like `my_thumbnail` from view template, the view helpers(htImgUrl and htDisplayImage) check if the cached image exists. If the cached image exists, it just returns the url to cached image. Else, it return the url where the image is displayed.  Also a new cached image is created in the web root!

## Documentation
The officially documentation is available in the [docs/](https://github.com/hrevert/HtImgModule/tree/master/docs) directory:

## Acknowledgements
HtImgModule is inspired by [AvalancheImagineBundle](https://github.com/avalanche123/AvalancheImagineBundle) and [LiipImagineBundle](https://github.com/liip/LiipImagineBundle).
