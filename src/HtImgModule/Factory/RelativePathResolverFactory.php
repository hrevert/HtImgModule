<?php
namespace HtImgModule\Factory;

use Zend\View\Resolver;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RelativePathResolverFactory implements FactoryInterface
{
    protected $options;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->options = $serviceLocator->get('HtImg\ModuleOptions');
        $resolver = new Resolver\AggregateResolver();
        $resolver->attach($this->getMapResolver())    // this will be consulted first
                 ->attach($this->getStackResolver());

        return $resolver;
    }

    public function getStackResolver()
    {
        $stack = new Resolver\TemplatePathStack([
            'script_paths' => $this->options->getImgSourcePathStack()
        ]);
        $stack->setDefaultSuffix('');

        return $stack;
    }

    public function getMapResolver()
    {
        $map = new Resolver\TemplateMapResolver($this->options->getImgSourceMap());

        return $map;
    }
}
