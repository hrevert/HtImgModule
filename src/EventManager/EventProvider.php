<?php
namespace HtImgModule\EventManager;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;

abstract class EventProvider implements EventManagerAwareInterface
{
    /**
     * @var EventManagerInterface
     */
    protected $events;

    /**
     * Set the event manager instance used by this context
     *
     * @param  EventManagerInterface $events
     * @return mixed
     */
    public function setEventManager(EventManagerInterface $events)
    {
        $identifiers = array(__CLASS__, get_called_class());
        $events->setIdentifiers($identifiers);
        $this->events = $events;

        return $this;
    }

    /**
     * Retrieve the event manager
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (!$this->events instanceof EventManagerInterface) {
            $this->setEventManager(new EventManager());
        }

        return $this->events;
    }
}
