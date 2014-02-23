<?php
namespace HtImgModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use HtImgModule\Service\ImageService;
use HtImgModule\View\Model\ImageModel;

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
        $relativePath = $this->params()->fromRoute('relativePath');
        $filter = $this->params()->fromRoute('filter');
        if (!$relativePath || !$filter) {
            return $this->notFoundAction();
        }
        $image = $this->imageService->getImageFromRelativePath($relativePath, $filter);

        return new ImageModel($image);

    }
}
