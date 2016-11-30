<?php

namespace Swatch\TvBundle\Type\Youtube;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @author    Andras Debreczeni <andras.debreczeni@db-n.com>
 * @copyright 2016 deepblue networks AG
 */
class VideoContentDetails
{
    /** @var  \DateInterval */
    private $duration;

    /** @var  string */
    private $dimension;

    /** @var  string */
    private $definition;

    /** @var  string */
    private $caption;

    /** @var  boolean */
    private $licensedContent;

    /** @var  string */
    private $projection;

    /** @var  boolean */
    private $hasCustomThumbnail;

    public function __construct($data)
    {
        $this->duration           = new \DateInterval($data['duration']);
        $this->dimension          = isset($data['dimension']) ? $data['dimension'] : null;
        $this->definition         = isset($data['definition']) ? $data['definition'] : null;
        $this->caption            = isset($data['caption']) ? $data['caption'] : null;
        $this->licensedContent    = isset($data['licensedContent']) ? (bool)$data['licensedContent'] : null;
        $this->projection         = isset($data['projection']) ? $data['projection'] : null;
        $this->hasCustomThumbnail = isset($data['hasCustomThumbnail']) ? (bool)$data['hasCustomThumbnail'] : null;
    }

    /**
     * @return string
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * @return string
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @return boolean
     */
    public function isLicensedContent()
    {
        return $this->licensedContent;
    }

    /**
     * @return string
     */
    public function getProjection()
    {
        return $this->projection;
    }

    /**
     * @return boolean
     */
    public function hasCustomThumbnail()
    {
        return $this->hasCustomThumbnail;
    }

    public function getDuration()
    {
        $formattedString = [];

        if ($this->duration->h !== 0) {
            $format = "%h ";
            $format .= ($this->duration->h > 1) ? 'hours' : 'hour';
            $formattedString[] = $format;
        }

        if ($this->duration->i !== 0) {
            $format = "%i ";
            $format .= ($this->duration->i > 1) ? 'minutes' : 'minute';
            $formattedString[] = $format;
        }

        $formattedString[] = "%s seconds";

        return $this->duration->format(implode(', ', $formattedString));
    }
}
