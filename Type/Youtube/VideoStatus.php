<?php

namespace Swatch\TvBundle\Type\Youtube;

/**
 * @author    Andras Debreczeni <andras.debreczeni@db-n.com>
 * @copyright 2016 deepblue networks AG
 */
class VideoStatus
{
    /** @var  string */
    private $uploadStatus;

    /** @var  string */
    private $privacyStatus;

    /** @var  string */
    private $license;

    /** @var  boolean */
    private $embeddable;

    /** @var  boolean */
    private $publicStatsViewable;

    public function __construct($data)
    {
        $this->uploadStatus = isset($data['uploadStatus']) ? $data['uploadStatus'] : null;
        $this->privacyStatus = isset($data['privacyStatus']) ? $data['privacyStatus'] : null;
        $this->license = isset($data['license']) ? $data['license'] : null;
        $this->embeddable = isset($data['embeddable']) ? $data['embeddable'] : null;
        $this->publicStatsViewable = isset($data['publicStatsViewable']) ? $data['publicStatsViewable'] : null;
    }
}
