<?php

namespace Swatch\TvBundle\Type\Youtube;

/**
 * @author    Andras Debreczeni <andras.debreczeni@db-n.com>
 * @copyright 2016 deepblue networks AG
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
