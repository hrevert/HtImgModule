Displaying Images From Controller
=================================

This module also ships with [ImageStrategy](https://github.com/hrevert/HtImgModule/blob/master/src/HtImgModule/View/Strategy/ImageStrategy.php) and [ImageModel](https://github.com/hrevert/HtImgModule/blob/master/src/HtImgModule/View/Model/ImageModel.php) to help you display images from controller.

## Basic Usage

From your controller,
```php
namespace Applicaton\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use HtImgModule\View\Model\ImageModel;

class MyController extends AbstractActionController
{
    public function displayImageAction()
    {
        $imagine = $this->getServiceLocator()->get('HtImg\Imagine');
        $image = $imagine->open('path/to/image');
        return new ImageModel($image);
        
        // or you can simply do

        return new ImageModel('path/to/image');

        // you can also set output format


        $imagine = $this->getServiceLocator()->get('HtImg\Imagine');
        $image = $imagine->open('path/to/image');
        $model = new ImageModel($image);
        $model->setFormat('jpeg');  // Default is png
        return $model;
    }
}
```

### Navigation

* Continue to [Image Loaders](image-loaders.md)
* Back to [Using Filters](Using Filters.md)
* Move to [the Index](README.md)
