<?php
namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ImagineFactory implements FactoryInterface
{
    protected $classes = [
        'gd' => 'Imagine\Gd\Imagine',
        'imagick' => 'Imagine\Imagick\Imagine',
        'gmagick' => 'Imagine\Gmagick\Imagine'
    ];

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('HtImg\ModuleOptions');
        $class   = $this->classes[$options->getDriver()];

        return new $class;
    }
}
