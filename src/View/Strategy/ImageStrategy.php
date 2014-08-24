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
    protected $listeners = [];

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
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, [$this, 'selectRenderer'], $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, [$this, 'injectResponse'], $priority);
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
     * Sets ImageRenderer as Renderer when ImageModel is used
     *
     * @param  ViewEvent $e
     * @return void
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();
        if ($model instanceof ImageModel) {
            if (!$model->getImage() instanceof ImageInterface) {
                if (!$model->getImagePath()) {
                    throw new Exception\RuntimeException(
                        'You must provide Imagine\Image\ImageInterface or path of image'
                    );
                }
                $model->setImage($this->imagine->open($model->getImagePath()));
            }

            return new ImageRenderer;
        }
    }

    /**
     * Sets the response based on image returned by the renderer
     *
     * @param  ViewEvent $e
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $model = $e->getModel();
        if ($model instanceof ImageModel) {
            $result   = $e->getResult();

            $response = $e->getResponse();
            $response->setContent($result);

            $response->getHeaders()->addHeaderLine('Content-type', $this->getMimeType($model->getFormat()));
        }
    }

    /**
     * Internal
     *
     * Get the mime type based on format.
     *
     * @param string $format
     *
     * @return string mime-type
     *
     * @throws RuntimeException
     */
    protected function getMimeType($format)
    {
        static $mimeTypes = array(
            'jpeg'  => 'image/jpeg',
            'jpg'   => 'image/jpeg',
            'pjpeg' => 'image/jpeg',
            'gif'   => 'image/gif',
            'png'   => 'image/png',
            'wbmp'  => 'image/vnd.wap.wbmp',
            'xbm'   => 'image/xbm',
        );

        return $mimeTypes[$format];
    }
}
