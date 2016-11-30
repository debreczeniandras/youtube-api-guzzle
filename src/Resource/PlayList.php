<?php

namespace Dga\Youtube\Resource;

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;

/**
 * @author    Andras Debreczeni <gitlab@debreczeniandras.hu>
 */
class PlayList implements ResponseClassInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $etag;

    /** @var VideoSnippet */
    private $snippet;

    /** @var VideoPlayer */
    private $player;

    /**
     * {@inheritdoc}
     */
    public static function fromCommand(OperationCommand $command)
    {
        $response = $command->getResponse()->json();

        if ($response['pageInfo']['totalResults'] !== 1) {
            return null;
        }

        $item = $response['items'][0];

        if ($item['kind'] !== 'youtube#playlist') {
            return null;
        }

        return new self($item);
    }

    public function __construct($item)
    {
        $this->id   = $item['id'];
        $this->etag = $item['etag'];

        if (isset($item['snippet'])) {
            $this->snippet = new PlayListSnippet($item['snippet']);
        }

        if (isset($item['player'])) {
            $this->player = new VideoPlayer($item['player']);
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEtag()
    {
        return $this->etag;
    }

    /**
     * @return VideoSnippet
     */
    public function getSnippet()
    {
        return $this->snippet;
    }

    /**
     * @return VideoPlayer
     */
    public function getPlayer()
    {
        return $this->player;
    }
}
