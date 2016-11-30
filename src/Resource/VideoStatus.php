<?php

namespace Dga\Youtube\Resource;

/**
 * @author    Andras Debreczeni <gitlab@debreczeniandras.hu>
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
