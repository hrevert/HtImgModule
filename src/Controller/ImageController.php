<?php
namespace HtImgModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use HtImgModule\Service\ImageServiceInterface;
use HtImgModule\View\Model\ImageModel;
use HtImgModule\Exception;

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
        $relativePath = $this->plugin('params')->fromQuery('relativePath');
        $filter       = $this->plugin('params')->fromRoute('filter');
        if (!$relativePath || !$filter) {
            return $this->notFoundAction();
        }
        try {
            $imageData = $this->imageService->getImage($relativePath, $filter);
        } catch (Exception\ImageNotFoundException $e) {
            return $this->notFoundAction();
        } catch (Exception\FilterNotFoundException $e) {
            return $this->notFoundAction();
        }

        if (!$imageData) {
            return $this->notFoundAction();
        }

        return new ImageModel($imageData['image'], $imageData['format']);
    }
}
