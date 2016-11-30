<?php

namespace Dga\Youtube\Resource;

/**
 * @author    Andras Debreczeni <gitlab@debreczeniandras.hu>
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
