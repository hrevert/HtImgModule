Caching
====================
This module supports caching of filtered/manipulated images in the web root so that on the next request, the cached image would be served directly from the file system.

## Configuration
```php
// in config/module.config.php or config/autoload/ht-img-module.global.php
return [
    'enable_cache' => true,
    'web_root' => 'public',
    'cache_path' => 'htimg',
];
```

Using this configuration, the filtered/manipulated images are cached in `public/htimg`.

## Enabling/Disabling caching for each filter service
Using the filter options, `enable_cache`, you can specify different caching option for different filter service.
For example,
```php
return [
    'htimg' => [
        'filters' => [
            'my_filter1' => [
                'type' => 'filter_type',
                'options' => [
                    // .....
                   'enable_cache' => true,
                ]
            ],
            'my_filter2' => [
                'type' => 'filter_type',
                'options' => [
                    // .....
                   'enable_cache' => false,
                ]
            ]
        ]
    ]
];
```
In this example, caching is enabled for 'my_filter1' and disabled for 'my_filter2'.

### Navigation

* Back to [Image Path Resolver](Image Path Resolver.md)
* Go to [the Index](README.md)