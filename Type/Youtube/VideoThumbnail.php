<?php

namespace Swatch\TvBundle\Type\Youtube;

/**
 * @author    Andras Debreczeni <andras.debreczeni@db-n.com>
 * @copyright 2016 deepblue networks AG
 */
class VideoThumbnail
{
    /** @var string */
    private $url;

    /** @var integer */
    private $width;

    /** @var integer */
    private $height;

    /**
     * VideoThumbnail constructor.
     *
     * @param $url
     * @param $width
     * @param $height
     */
    public function __construct($url, $width, $height)
    {
        $this->url    = $url;
        $this->width  = (int) $width;
        $this->height = (int) $height;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }
}
