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
        ]
    ]
];
```