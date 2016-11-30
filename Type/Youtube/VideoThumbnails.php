<?php

namespace Swatch\TvBundle\Type\Youtube;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @author    Andras Debreczeni <andras.debreczeni@db-n.com>
 * @copyright 2016 deepblue networks AG
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
