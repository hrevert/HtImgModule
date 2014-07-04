<?php
namespace HtImgModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser as SymfonyMimeTypeGuesser;
use HtImgModule\Binary\MimeTypeGuesser;

class MimeTypeGuesserFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $symfonyMimeTypeGuesser = SymfonyMimeTypeGuesser ::getInstance();

        return new MimeTypeGuesser($symfonyMimeTypeGuesser);
    }
}
