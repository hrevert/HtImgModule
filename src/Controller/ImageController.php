<?php
namespace HtImgModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use HtImgModule\Service\ImageServiceInterface;
use HtImgModule\View\Model\ImageModel;
use Imagine\Exception\InvalidArgumentException;

class ImageController extends AbstractActionController
{
    /**
     * @var ImageServiceInterface
     */
    protected $imageService;

    /**
     * Constructor
     *
     * @param ImageServiceInterface $imageService
     */
    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Displays image
     */
    public function displayAction()
    {
        $relativePath = $this->params()->fromQuery('relativePath');
        $filter = $this->params()->fromRoute('filter');
        if (!$relativePath || !$filter) {
            return $this->notFoundAction();
        }
        try {
            $imageData = $this->imageService->getImageFromRelativePath($relativePath, $filter);
        } catch (InvalidArgumentException $e) {
            return $this->notFoundAction();
        }

        if (!$imageData) {
            return $this->notFoundAction();
        }

        $imageModel = new ImageModel($imageData['image']);
        $imageModel->setFormat($imageData['format']);

        return $imageModel;

    }
}
