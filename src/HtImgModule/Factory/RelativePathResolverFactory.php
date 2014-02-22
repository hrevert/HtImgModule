<?php
namespace HtImgModule\Factory;

use Zend\View\Resolver;

use Zend\ServiceManager\FactoryInterface;

class RelativePathResolverFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('HtImg\ModuleOptions');
        $map = new Resolver\TemplateMapResolver($options->getImgSourceMap());
        $stack = new Resolver\TemplatePathStack([
            'script_paths' => $options->getImgSourcePathStack()
        ]);
        $resolver = new Resolver\AggregateResolver();
        $resolver->attach($map)    // this will be consulted first
                 ->attach($stack);
        return $resolver;
    }
}
