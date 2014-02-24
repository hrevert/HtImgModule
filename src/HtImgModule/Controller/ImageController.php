<?php
namespace HtImgModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use HtImgModule\Service\ImageService;
use HtImgModule\View\Model\ImageModel;
use Imagine\Exception\InvalidArgumentException;

class ImageController extends AbstractActionController
{
    /**
     * @var ImageService
     *
     */
    protected $imageService;

    /**
     * Constructor
     *
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function displayAction()
    {
        $relativePath = $this->params()->fromQuery('relativePath');
        $filter = $this->params()->fromRoute('filter');
        if (!$relativePath || !$filter) {
            return $this->notFoundAction();
        }
        try {
            $image = $this->imageService->getImageFromRelativePath($relativePath, $filter);
        } catch (InvalidArgumentException $e) {
            return $this->notFoundAction();
        }

        if (!$image) {
            return $this->notFoundAction();
        }

        return new ImageModel($image);

    }
}
