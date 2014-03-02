Image Path Resolver
=========================
Image Path Resolver is similiar to Zend Framework 2 view template resolvers(Actually an instance of configured `Zend\View\Resolver\AggregateResolver`).

Whenever, you provide image relative path to view helper like this:

```php
 <?php echo $this->htDisplayImage('my_image.png', 'my_thumbnail', ['alt' => 'Hello']); ?
```
Here, the image path resolver will look for relative path, `my_image.png` in the image source path stack which can be configured as:

```php
return [
    'htimg' => [
        'img_source_path_stack' => [
            'data/images/',
            'module/Application/data/images',
            // and so on
        ],
        'img_source_map'=> [
            'my/special/image'      => 'path/to/my/special/image',
            'another/special/image' => 'path/to/another/special/image',
            // and so on
        ]
    ]
];
```
The image resolver will first try to resolve the image from source map and then from source path stack.