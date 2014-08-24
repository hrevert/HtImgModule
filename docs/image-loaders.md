Image Loaders
========================
Image loaders load image from image path and return binary. Image loader must implement `HtImgModule\Imagine\Loader\LoaderInterface`.
Image loaders are configured with filters so that image are loaded by the respective image loader.

For example:
```php

retutn [
    'htimg' => [
        'filters' => [
            'filter_name' => [
                'type' => 'filter_type',
                'options' => [
                    'image_loader' => 'my_image_loader_service',
                    // ... other options
                ]
            ]
        ],
        'loaders' => [
            'invokables' => [
                'my_image_loader_service' => 'Application\Imagine\Loader\MyImageLoader',
            ]
        ]
    ]
];
```

## Available implementations
#### HtImgModule\Imagine\Loader\SimpleFileSystemLoader
This image loader is used to load images from a certain path.
```php
$imageLoader = new HtImgModule\Imagine\Loader\SimpleFileSystemLoader('data/path/to/images');
$binary = $imageLoader->load('my-image.png');
```

This module can be used to load images by configuring like this:

```php
return [
    'htimg' => [
        'filters' => [
            'my_filter' => [
                'type' => 'filter_type',
                'options' => [
                    // .....
                    'image_loader' => 'simple',
                    'loader_options' => [
                        'root_path' => 'data/images/uploads',
                    ]
                ]
            ]        
        ]
    ]
]
```

#### HtImgModule\Imagine\Loader\FileSystemLoader
This image loaders resolves full path of image using image resolver and loads the image.
```php
/** @var HtImgModule\Imagine\Resolver\ResolverInterface */
$resolver = ....;

$imageLoader = new HtImgModule\Imagine\Loader\FileSystemLoader($resolver);
```

#### HtImgModule\Imagine\Loader\FlysystemLoader
This image loader uses [flysystem](https://github.com/thephpleague/flysystem) library to load images.
You need to install [flysystem](https://github.com/thephpleague/flysystem) to use this impementation;
```php
/** @var League\Flysystem\FilesystemInterface */
$flysystem = ....;

$imageLoader = new HtImgModule\Imagine\Loader\FlysystemLoader($flysystem);
```

#### HtImgModule\Imagine\Loader\GaufretteLoader
This image loader uses [Gaufrette](https://github.com/KnpLabs/Gaufrette) to load images.
You need to install [Gaufrette](https://github.com/KnpLabs/Gaufrette) library to use this impementation;
```php
/** @var Gaufrette\Filesystem */
$fileSystem = ....;

$imageLoader = new HtImgModule\Imagine\Loader\GaufretteLoader($fileSystem);
```

### Navigation

* Back to [Displaying Images From Controller](Images From Controller.md)
* Continue to [Image Path Resolver](Image Path Resolver.md)