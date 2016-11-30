<?php

namespace Swatch\TvBundle\Type\Youtube;

/**
 * @author    Andras Debreczeni <andras.debreczeni@db-n.com>
 * @copyright 2016 deepblue networks AG
 */
class VideoPlayer
{
    /** @var  string of html */
    private $embedHtml;

    /** @var  int */
    private $embedWidth;

    /** @var  int */
    private $embedHeight;

    /**
     * @param $data array
     */
    public function __construct($data)
    {
        $this->embedHtml   = isset($data['embedHtml']) ? $data['embedHtml'] : null;
        $this->embedWidth  = isset($data['embedWidth']) ? (int) $data['embedWidth'] : Video::DEFAULT_WIDTH;
        $this->embedHeight = isset($data['embedHeight']) ? (int) $data['embedHeight'] : Video::DEFAULT_HEIGHT;
    }

    /**
     * @return string
     */
    public function getEmbedHtml()
    {
        return $this->embedHtml;
    }

    /**
     * @return int
     */
    public function getEmbedWidth()
    {
        return $this->embedWidth;
    }

    /**
     * @return int
     */
    public function getEmbedHeight()
    {
        return $this->embedHeight;
    }
}
