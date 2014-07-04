<?php
namespace HtImgModule\Imagine\Loader;

class CallbackLoader implements LoaderInterface
{
    /**
     * @var callable
     */
    protected $callback;

    /**
     * Constructor
     *
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * {@inheritDoc}
     */
    public function load($path)
    {
        return call_user_func($this->callback, $path);
    }
}
