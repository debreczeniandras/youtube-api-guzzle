<?php

namespace Dga\Youtube\Response;

use Dga\Youtube\Resource\Video;
use Doctrine\Common\Collections\ArrayCollection;
use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;

/**
 * @author    Andras Debreczeni <gitlab@debreczeniandras.hu>
 */
class VideoListResponse implements ResponseClassInterface
{
    private $etag;
    private $nextPageToken;
    private $prevPageToken;
    private $pageInfo;
    private $items;

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
        $this->pageInfo      = $response['pageInfo'];

        $items = array_map(function ($item) {
            return new Video($item);
        }, $response['items']);

        $this->items = new ArrayCollection($items);
    }

    /**
     * @return mixed
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
}
