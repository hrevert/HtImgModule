<?php
namespace HtImgModule\View\Strategy;

use HtImgModule\View\Model\ImageModel;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\View\ViewEvent;
use Imagine\Image\ImagineInterface;
use Imagine\Image\ImageInterface;
use HtImgModule\Exception;
use HtImgModule\View\Renderer\ImageRenderer;

class ImageStrategy implements ListenerAggregateInterface
{
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array(); 
    
    /**
     * @var ImagineInterface
     */
    protected $imagine; 

    /**
     * Constructor
     *
     * @param ImagineInterface $imagine
     */
    public function __construct(ImagineInterface $imagine)
    {
        $this->imagine = $imagine;
    }
    
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'passImagine'), $priority);
    }
    
    /**
     * {@inheritDoc}
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
    
    /**
     * Passes the instance of image to the ViewModel when path of image is provided
     *
     * @param ViewEvent $e
     * @return void
     * @throwns Exception\RuntimeException
     */
    public function passImagine(ViewEvent $e)
    {
        $model = $e->getModel();
        if (!$model instanceof ImageModel) {
            return ;
        }
        if (!$model->getImage() instanceof ImageInterface) {
            if (!$model->getImagePath()) {
                throw new Exception\RuntimeException(
                    'You must provide Imagine\Image\ImageInterface or path of image'
                );
            }
            $model->setImage($this->imagine->open($model->getImagePath()));
        }
        $model->setVariable('image', $model->getImage());        
    }
    
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();
        if ($model instanceof ImageModel) {
            return new ImageRenderer;
        }
    }          
}
