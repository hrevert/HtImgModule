Image Path Resolver
=========================
Image Path Resolver is similiar to Zend Framework 2 view template resolvers(Actually an extension of `Zend\View\Resolver\AggregateResolver`).

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
Here, the image resolver will first try to resolve the image from source map and then from source path stack.

## Creating Custom Image Path Resolvers
At some cases, it is not so easy to resolve image from only the above resolvers and you may want to create your own resolver.

First you want to create resolver class.

```php
namespace Application\Imagine\Resolver;

use HtImgModule\Imagine\Resolver\ResolverInterface;
use Zend\View\Renderer\RendererInterface as Renderer;

class MyPathResolver implements ResolverInterface
{
    public function resolve($name, Renderer $renderer = null)
    {
        // write your code here
    }
}
```

Then, inform the module about our new resolver like this:

```php
return [
    'htimg' => [
        'resolvers_manager' => [
            'invokables' => [
                'MyPathResolver' => 'Application\Imagine\Resolver\MyPathResolver',
            ],

            // or you can also create a factory

            'factories' => [
                'MyPathResolver' => 'Application\Imagine\Resolver\Factory\MyPathResolverFactory',
            ],
        ]
    ]
];
```

Now, the tell the module to queue the resolver in the resolver chain:

```php
return [
    'himg' => [
        'image_resolvers' => [
            270 => 'MyPathResolver', // 270 is the priority
        ]
    ]
];
```
Here 270 is the priority of the resolver. The resolvers having high priority are consulted first.