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

    /**
     * Gets valid HTML image tag or self when $relativeName is not provided
     *
     * @param  string $relativeName Relative Path
     * @param  string $filter       Filter Service
     * @param  array  $attributes   Attributes for HTML image tag
     * @return string
     */
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
     * Return valid HTML image tag
     *
     * @return string
     */
    public function getImgTag($relativeName, $filter)
    {
        $imgUrlHelper = $this->getView()->plugin('HtImgModule\View\Helper\ImgUrl');
        $this->attributes['src'] = $imgUrlHelper($relativeName, $filter);;
        $html = '<img'
            . $this->htmlAttribs($this->getAttributes())
            . $this->getClosingBracket();

        return $html;
    }

    /**
     * Sets attributes of HTML image tag
     *
     * @param  array $attributes
     * @return self
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Gets attributes of img tag
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

}
