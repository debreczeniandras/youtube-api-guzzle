<?php

namespace Dga\Youtube\Resource;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @author    Andras Debreczeni <gitlab@debreczeniandras.hu>
 */
class VideoThumbnails extends ParameterBag
{
    private static $availableSizes = ['default', 'medium', 'high', 'standard', 'maxres'];

    /**
     * @param $name
     *
     * @return VideoThumbnail
     */
    public function __get($name)
    {
        if (!in_array($name, self::$availableSizes)) {
            throw new \InvalidArgumentException();
        }

        if ($this->has($name)) {
            return $this->get($name);
        }

        return $this->get('high');
    }

    public function __isset($name)
    {
        return in_array($name, self::$availableSizes);
    }
}
