<?php

namespace Dga\Youtube\Response;

use Dga\Youtube\Resource\Video;
use Doctrine\Common\Collections\ArrayCollection;
use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;

/**
 * @author    Andras Debreczeni <gitlab@debreczeniandras.hu>
 */
class SearchListResponse implements ResponseClassInterface, \Countable
{
    /** @var string */
    private $etag;

    /** @var string|null */
    private $nextPageToken;

    /** @var string|null */
    private $prevPageToken;

    /** @var array */
    private $pageInfo;

    /** @var ArrayCollection */
    private $items;

    /** @var string|null */
    private $regionCode;

    /** @var Video[]|ArrayCollection */
    private $videos;

    /**
     * {@inheritdoc}
     */
    public static function fromCommand(OperationCommand $command)
    {
        $response = $command->getResponse()->json();

        return new self($response);
    }

    /**
     * @param array $response
     */
    public function __construct($response)
    {
        $this->etag          = $response['etag'];
        $this->nextPageToken = isset($response['nextPageToken']) ? $response['nextPageToken'] : null;
        $this->prevPageToken = isset($response['prevPageToken']) ? $response['prevPageToken'] : null;
        $this->pageInfo      = isset($response['pageInfo']) ? $response['pageInfo'] : [];
        $this->regionCode    = isset($response['regionCode']) ? $response['regionCode'] : null;

        $videos = array_map(function ($item) {
            if ($item['id']['kind'] === 'youtube#video') {
                return Video::fromSearchResult($item);
            }
        }, $response['items']);

        // @todo should handle different resource types later (channel, playlist, etc.)
//        $channel = array_map(function ($item) {
//            if ($item['id']['kind'] === 'youtube#channel') {
//                return Channel::fromSearchResult($item);
//            }
//        }, $response['items']);

        $this->videos = new ArrayCollection($videos);
    }

    /**
     * @return array
     */
    public function getPageInfo()
    {
        return $this->pageInfo;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return ArrayCollection|Video[]
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return $this->pageInfo['totalResults'];
    }
}
