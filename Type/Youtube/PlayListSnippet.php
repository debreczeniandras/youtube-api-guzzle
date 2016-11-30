<?php

namespace Swatch\TvBundle\Type\Youtube;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @author    Andras Debreczeni <andras.debreczeni@db-n.com>
 * @copyright 2016 deepblue networks AG
 */
class PlayListSnippet
{
    /** @var string */
    private $publishedAt;

    /** @var string */
    private $channelId;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var VideoThumbnails */
    private $thumbnails;

    /** @var string */
    private $channelTitle;

    /** @var array */
    private $localized;

    public function __construct($data)
    {
        $this->publishedAt = isset($data['publishedAt']) ? new \DateTime($data['publishedAt']) : null;
        $this->channelId = isset($data['channelId']) ? $data['channelId'] : null;
        $this->title = isset($data['title']) ? $data['title'] : null;
        $this->description = isset($data['description']) ? $data['description'] : null;
        $this->thumbnails = $this->setThumbnails($data['thumbnails']);
        $this->channelTitle = isset($data['channelTitle']) ? $data['channelTitle'] : null;
        $this->localized = isset($data['localized']) ? $data['localized'] : [];
    }

    /**
     * @param $data
     *
     * @return ParameterBag
     */
    private function setThumbnails($data)
    {
        $thumbnails = new VideoThumbnails();

        foreach ($data as $size => $thumbnail) {
            $thumbnails->set($size, new VideoThumbnail($thumbnail['url'], $thumbnail['width'], $thumbnail['height']));
        }

        return $thumbnails;
    }

    /**
     * @return string
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return ParameterBag
     */
    public function getThumbnails()
    {
        return $this->thumbnails;
    }
}
