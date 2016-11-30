<?php

namespace Dga\Youtube\Resource;

/**
 * @author    Andras Debreczeni <dev@debreczeniandras.hu>
 */
class VideoStatistics
{
    /** @var  integer */
    private $viewCount;

    /** @var  integer */
    private $likeCount;

    /** @var  integer */
    private $dislikeCount;

    /** @var  integer */
    private $favoriteCount;

    /** @var  integer */
    private $commentCount;

    /**
     * @param $statistics
     */
    public function __construct($statistics)
    {
        $this->viewCount = isset($statistics['viewCount']) ? (int) $statistics['viewCount'] : null;
        $this->likeCount = isset($statistics['likeCount']) ? (int) $statistics['likeCount'] : null;
        $this->dislikeCount = isset($statistics['dislikeCount']) ? (int) $statistics['dislikeCount'] : null;
        $this->favoriteCount = isset($statistics['favoriteCount']) ? (int) $statistics['favoriteCount'] : null;
        $this->commentCount = isset($statistics['commentCount']) ? (int) $statistics['commentCount'] : null;
    }

    /**
     * @return int
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }

    /**
     * @return int
     */
    public function getLikeCount()
    {
        return $this->likeCount;
    }

    /**
     * @return int
     */
    public function getDislikeCount()
    {
        return $this->dislikeCount;
    }

    /**
     * @return int
     */
    public function getFavoriteCount()
    {
        return $this->favoriteCount;
    }

    /**
     * @return int
     */
    public function getCommentCount()
    {
        return $this->commentCount;
    }
}
