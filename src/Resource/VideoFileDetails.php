<?php

namespace Dga\Youtube\Resource;

/**
 * @author    Andras Debreczeni <gitlab@debreczeniandras.hu>
 */
class VideoFileDetails
{
    /** @var string  */
    private $fileName;

    /**
     * @param $data array
     */
    public function __construct($data)
    {
        if (isset($data['fileName']) && $data['fileName'] !== 'unknown') {
            $this->fileName = (string) $data['fileName'];
        }
    }
}
