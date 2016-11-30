<?php

namespace Swatch\TvBundle\Type\Youtube;

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;

/**
 * @author    Andras Debreczeni <andras.debreczeni@db-n.com>
 * @copyright 2016 deepblue networks AG
 */
class Video implements ResponseClassInterface
{
    const DEFAULT_WIDTH  = 1004;
    const DEFAULT_HEIGHT = 565;

    /** @var string */
    private $id;

    /** @var string */
    private $etag;

    /** @var VideoSnippet */
    private $snippet;

    /** @var VideoContentDetails */
    private $contentDetails;

    /** @var VideoStatus */
    private $status;

    /** @var VideoStatistics  */
    private $statistics;

    /** @var VideoPlayer */
    private $player;

    /** @var VideoFileDetails */
    private $fileDetails;

    /** @var VideoEmbedParameters */
    private $embed;

    /** @var int */
    private $width = self::DEFAULT_WIDTH;

    /** @var int */
    private $height = self::DEFAULT_HEIGHT;


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

        if ($item['kind'] !== 'youtube#video') {
            return null;
        }

        return new self($item);
    }

    public function __construct($item)
    {
        $this->id   = $item['id'];
        $this->etag = $item['etag'];

        if (isset($item['snippet'])) {
            $this->snippet = new VideoSnippet($item['snippet']);
        }

        if (isset($item['contentDetails'])) {
            $this->contentDetails = new VideoContentDetails($item['contentDetails']);
        }

        if (isset($item['status'])) {
            $this->status = new VideoStatus($item['status']);
        }

        if (isset($item['statistics'])) {
            $this->statistics = new VideoStatistics($item['statistics']);
        }

        if (isset($item['player'])) {
            $this->player = new VideoPlayer($item['player']);
        }

        if (isset($item['fileDetails'])) {
            $this->fileDetails = new VideoFileDetails($item['fileDetails']);
        }

        $this->embed = new VideoEmbedParameters();
    }

    /**
     * @param $searchResult
     *
     * @return Video
     */
    public static function fromSearchResult($searchResult)
    {
        $item            = [];
        $item['id']      = $searchResult['id']['videoId'];
        $item['etag']    = null;
        $item['snippet'] = $searchResult['snippet'];

        return new self($item);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @return string
     */
    public function getEtag()
    {
        return $this->etag;
    }

    /**
     * @return VideoContentDetails
     */
    public function getContentDetails()
    {
        return $this->contentDetails;
    }

    /**
     * @return VideoStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return VideoStatistics
     */
    public function getStatistics()
    {
        return $this->statistics;
    }

    /**
     * @return VideoFileDetails
     */
    public function getFileDetails()
    {
        return $this->fileDetails;
    }

    /**
     * @return VideoEmbedParameters
     */
    public function getEmbed()
    {
        return $this->embed;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     *
     * @return Video
     */
    public function setWidth($width)
    {
        $this->width = (int)$width;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     *
     * @return Video
     */
    public function setHeight($height)
    {
        $this->height = (int)$height;

        return $this;
    }

    /**
     * Used in templates to render proper padding.
     * Round it up olways to its closes fourth (0, 0.25, 0.5, 0.75)
     *
     * Default case returns something like 56.25(%)
     *
     * @return float
     */
    public function getRatio()
    {
        $rawRatio = $this->height / $this->width * 100;

        // round it up to two digits
        $exactFraction = floor($rawRatio);

        // now divide it to 4, we should get the nearest fourth
        $fourthRound = $exactFraction + (round(($rawRatio - $exactFraction) * 4) * .25);

        return $fourthRound;
    }

    /**
     * @return string
     */
    public function getEmbedUrl()
    {
        $embedUrl    = "https://www.youtube.com/embed/%s%s";
        $embedParams = $this->embed->getNonNullProperties();

        $query = '';
        if ($embedParams) {
            $query = '?' . http_build_query($embedParams);
        }

        return sprintf($embedUrl, $this->id, $query);
    }

    /**
     * @return string
     */
    public function getLightboxUrl()
    {
        $watchUrl = "https://www.youtube.com/watch?v=%s";

        return sprintf($watchUrl, $this->id);
    }
}
