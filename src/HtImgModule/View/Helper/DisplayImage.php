<?php

namespace HtImgModule\View\Helper;

use Zend\View\Helper\AbstractHtmlElement;

class DisplayImage extends AbstractHtmlElement
{
    /**
     * Attributes for HTML image tag
     *
     * @var array
     */
    protected $attributes;

    public function __invoke($relativeName = null, $filter = null, $attributes = null)
    {
        if ($relativeName === null) {
            return $this;
        }
        if ($attributes !== null) {
            $this->setAttributes($attributes);
        }
        return $this->getImgTag($relativeName, $filter);
    }

    /**
     * Return valid image tag
     *
     * @return string
     */
    public function getImgTag($relativeName, $filter)
    {
        $this->attributes['src'] = $this->getView()->htImgUrl($relativeName, $filter);;
        $html = '<img'
            . $this->htmlAttribs($this->getAttributes())
            . $this->getClosingBracket();

        return $html;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }
      
}
