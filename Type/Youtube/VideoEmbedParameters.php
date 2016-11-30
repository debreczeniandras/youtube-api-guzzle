<?php

namespace Swatch\TvBundle\Type\Youtube;

use Swatch\WebBundle\Services\LocaleService;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A simple object holding the parameters we can use for rendering a proper embed url.
 *
 * @author    Andras Debreczeni <andras.debreczeni@db-n.com>
 * @copyright 2016 deepblue networks AG
 */
final class VideoEmbedParameters
{
    /**
     * This parameter specifies whether the initial video will automatically start to play when the player loads.
     * Supported values are 0 or 1. The default value is 0.
     *
     * @var integer 0 or 1
     *
     * @Assert\Type(type="integer")
     * @Assert\Range(max="1", min="1")
     */
    private $autoplay;

    /**
     * Setting the parameter's value to 1 causes closed captions to be shown by default, even if the user has turned
     * captions off. The default behavior is based on user preference.
     *
     * @var integer
     *
     * @Assert\Type(type="integer")
     * @Assert\Range(max="1", min="1")
     */
    private $cc_load_policy;

    /**
     * This parameter specifies the color that will be used in the player's video progress bar to highlight the amount
     * of the video that the viewer has already seen. Valid parameter values are red and white, and, by default, the
     * player uses the color red in the video progress bar. See the YouTube API blog for more information about color
     * options.
     *
     * Note: Setting the color parameter to white will disable the modestbranding option.
     *
     * @var string 'white' or 'red'
     *
     * @Assert\Choice(['white', 'red'])
     */
    private $color;

    /**
     * This parameter indicates whether the video player controls are displayed. For IFrame embeds that load a Flash
     * player, it also defines when the controls display in the player as well as when the player will load. Supported
     * values are:
     *
     * controls=0
     *      – Player controls do not display in the player. For IFrame embeds, the Flash player loads immediately.
     * controls=1 (default)
     *      – Player controls display in the player. For IFrame embeds, the controls display immediately and the Flash
     *      player also loads immediately. controls=2 – Player controls display in the player. For IFrame embeds, the
     *      controls display and the Flash player loads after the user initiates the video playback.
     *
     * Note: The parameter values 1 and 2 are intended to provide an identical user experience, but controls=2 provides
     * a performance improvement over controls=1 for IFrame embeds. Currently, the two values still produce some visual
     * differences in the player, such as the video title's font size. However, when the difference between the two
     * values becomes completely transparent to the user, the default parameter value may change from 1 to 2.
     *
     * @var integer
     *
     * @Assert\Type(type="integer")
     * @Assert\Range(min=0, max=1)
     */
    private $controls;

    /**
     * Setting the parameter's value to 1 causes the player to not respond to keyboard controls. The default value is
     * 0, which means that keyboard controls are enabled. Currently supported keyboard controls are:
     *
     * Spacebar or [k]: Play / Pause
     * Arrow Left: Jump back 5 seconds in the current video
     * Arrow Right: Jump ahead 5 seconds in the current video
     * Arrow Up: Volume up
     * Arrow Down: Volume Down
     * [f]: Toggle full-screen display
     * [j]: Jump back 10 seconds in the current video
     * [l]: Jump ahead 10 seconds in the current video
     * [m]: Mute or unmute the video
     * [0-9]: Jump to a point in the video. 0 jumps to the beginning of the video, 1 jumps to the point 10% into the
     * video, 2 jumps to the point 20% into the video, and so forth.
     *
     * @var integer
     *
     * @Assert\Range(min=0, max=1)
     * @Assert\Type(type="integer")
     */
    private $disablekb;

    /**
     * Setting the parameter's value to 1 enables the player to be controlled via IFrame or JavaScript Player API
     * calls. The default value is 0, which means that the player cannot be controlled using those APIs.
     *
     * For more information on the IFrame API and how to use it, see the IFrame API documentation. (The JavaScript
     * Player API has already been deprecated.)
     *
     * @var integer
     *
     * @Assert\Range(min=0, max=1)
     * @Assert\Type(type="integer")
     */
    private $enablejsapi;

    /**
     * This parameter specifies the time, measured in seconds from the start of the video, when the player should stop
     * playing the video. The parameter value is a positive integer.
     *
     * Note that the time is measured from the beginning of the video and not from either the value of the start player
     * parameter or the startSeconds parameter, which is used in YouTube Player API functions for loading or queueing a
     * video.
     *
     * @var integer
     *
     * @Assert\GreaterThan(value="0")
     * @Assert\Type(type="integer")
     */
    private $end;

    /**
     * Setting this parameter to 0 prevents the fullscreen button from displaying in the player. The default value is
     * 1, which causes the fullscreen button to display.
     *
     * @var integer
     *
     * @Assert\Range(min=0, max=1)
     * @Assert\Type(type="integer")
     */
    private $fs;

    /**
     * Sets the player's interface language. The parameter value is an ISO 639-1 two-letter language code or a fully
     * specified locale. For example, fr and fr-ca are both valid values. Other language input codes, such as IETF
     * language tags (BCP 47) might also be handled properly.
     *
     * The interface language is used for tooltips in the player and also affects the default caption track. Note that
     * YouTube might select a different caption track language for a particular user based on the user's individual
     * language preferences and the availability of caption tracks.
     *
     * @var string
     *
     * @Assert\Length(min=2)
     * @Assert\Type(type="string")
     */
    private $hl;

    /**
     * Setting the parameter's value to 1 causes video annotations to be shown by default, whereas setting to 3 causes
     * video annotations to not be shown by default. The default value is 1.
     *
     * @var integer
     *
     * @Assert\Range(min=0, max=1)
     * @Assert\Type(type="integer")
     */
    private $iv_load_policy;

    /**
     * The list parameter, in conjunction with the listType parameter, identifies the content that will load in the
     * player.
     *
     * If the listType parameter value is search, then the list parameter value specifies the search query.
     * If the listType parameter value is user_uploads, then the list parameter value identifies the YouTube channel
     * whose uploaded videos will be loaded. If the listType parameter value is playlist, then the list parameter value
     * specifies a YouTube playlist ID. In the parameter value, you need to prepend the playlist ID with the letters PL
     * as shown in the example below.
     *
     * https://www.youtube.com/embed?
     * listType=playlist
     * &list=PLC77007E23FF423C6
     *
     * Note: If you specify values for the list and listType parameters, the IFrame embed URL does not need to specify
     * a video ID.
     *
     * @var string
     */
    private $list;

    /**
     * The listType parameter, in conjunction with the list parameter, identifies the content that will load in the
     * player. Valid parameter values are playlist, search, and user_uploads.
     *
     * If you specify values for the list and listType parameters, the IFrame embed URL does not need to specify a
     * video ID.
     *
     * @var string
     *
     * @Assert\Choice({'search', 'user_uploads', 'playlist'})
     */
    private $listType;

    /**
     * In the case of a single video player, a setting of 1 causes the player to play the initial video again and
     * again. In the case of a playlist player (or custom player), the player plays the entire playlist and then starts
     * again at the first video.
     *
     * Supported values are 0 and 1, and the default value is 0.
     *
     * Note: This parameter has limited support in the AS3 player and in IFrame embeds, which could load either the AS3
     * or HTML5 player. Currently, the loop parameter only works in the AS3 player when used in conjunction with the
     * playlist parameter. To loop a single video, set the loop parameter value to 1 and set the playlist parameter
     * value to the same video ID already specified in the Player API URL:
     *
     * @example https://www.youtube.com/v/VIDEO_ID?
     * version=3
     * &loop=1
     * &playlist=VIDEO_ID
     *
     * @var integer
     *
     * @Assert\Range(min=0, max=1)
     * @Assert\Type(type="integer")
     */
    private $loop;

    /**
     * This parameter lets you use a YouTube player that does not show a YouTube logo. Set the parameter value to 1 to
     * prevent the YouTube logo from displaying in the control bar. Note that a small YouTube text label will still
     * display in the upper-right corner of a paused video when the user's mouse pointer hovers over the player.
     *
     * @var integer
     *
     * @Assert\Range(min=0, max=1)
     * @Assert\Type(type="integer")
     */
    private $modestbranding = 1;

    /**
     * This parameter provides an extra security measure for the IFrame API and is only supported for IFrame embeds. If
     * you are using the IFrame API, which means you are setting the enablejsapi parameter value to 1, you should
     * always specify your domain as the origin parameter value.
     *
     * @var string the domain origin
     */
    private $origin;

    /**
     * This parameter specifies a comma-separated list of video IDs to play. If you specify a value, the first video
     * that plays will be the VIDEO_ID specified in the URL path, and the videos specified in the playlist parameter
     * will play thereafter.
     *
     * @var string
     */
    private $playlist;

    /**
     * This parameter controls whether videos play inline or fullscreen in an HTML5 player on iOS. Valid values are:
     *
     * 0:   This value causes fullscreen playback.
     *      This is currently the default value, though the default is subject to change.
     *
     * 1:   This value causes inline playback for UIWebViews created with the allowsInlineMediaPlayback property
     *      set to TRUE.
     *
     * @var integer
     *
     * @Assert\Range(min=0, max=1)
     * @Assert\Type(type="integer")
     */
    private $playsinline;

    /**
     * This parameter indicates whether the player should show related videos when playback of the initial video ends.
     * Supported values are 0 and 1. The default value is 1.
     *
     * @var integer
     *
     * @Assert\Range(min=0, max=1)
     * @Assert\Type(type="integer")
     */
    private $rel = 0;

    /**
     * Supported values are 0 and 1.
     *
     * Setting the parameter's value to 0 causes the player to not display information like the video title and
     * uploader before the video starts playing.
     *
     * If the player is loading a playlist, and you explicitly set the parameter value to 1, then, upon loading, the
     * player will also display thumbnail images for the videos in the playlist. Note that this functionality is only
     * supported for the AS3 player.
     *
     * @var integer
     *
     * @Assert\Range(min=0, max=1)
     * @Assert\Type(type="integer")
     */
    private $showinfo = 0;

    /**
     * This parameter causes the player to begin playing the video at the given number of seconds from the start of the
     * video. The parameter value is a positive integer. Note that similar to the seekTo function, the player will look
     * for the closest keyframe to the time you specify. This means that sometimes the play head may seek to just
     * before the requested time, usually no more than around two seconds.
     *
     * @var integer seconds
     *
     * @Assert\GreaterThan(value="0")
     * @Assert\Type(type="integer")
     */
    private $start;

    public function __construct()
    {
        $locale   = \Locale::getDefault();
        $this->hl = LocaleService::languageIsoFromLocale($locale);
    }

    /**
     * Returns all properties that have been set.
     * is_null must be used, as some parameters might still be valid 0 values.
     *
     * @return array
     */
    public function getNonNullProperties()
    {
        $properties = get_object_vars($this);

        return array_filter($properties, function ($property) {
            return !is_null($property);
        });
    }

    public function __set($name, $value)
    {
        throw new \InvalidArgumentException('Unknown property.');
    }

    public function __get($name)
    {
        throw new \InvalidArgumentException('Unknown property.');
    }

    /**
     * @return int
     */
    public function getAutoplay()
    {
        return $this->autoplay;
    }

    /**
     * @param int $autoplay
     *
     * @return VideoEmbedParameters
     */
    public function setAutoplay($autoplay)
    {
        $this->autoplay = (int) $autoplay;

        return $this;
    }

    /**
     * @return int
     */
    public function getCcLoadPolicy()
    {
        return $this->cc_load_policy;
    }

    /**
     * @param int $cc_load_policy
     *
     * @return VideoEmbedParameters
     */
    public function setCcLoadPolicy($cc_load_policy)
    {
        $this->cc_load_policy = (int) $cc_load_policy;

        return $this;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     *
     * @return VideoEmbedParameters
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return int
     */
    public function getControls()
    {
        return $this->controls;
    }

    /**
     * @param int $controls
     *
     * @return VideoEmbedParameters
     */
    public function setControls($controls)
    {
        $this->controls = $controls;

        return $this;
    }

    /**
     * @return int
     */
    public function getDisablekb()
    {
        return $this->disablekb;
    }

    /**
     * @param int $disablekb
     *
     * @return VideoEmbedParameters
     */
    public function setDisablekb($disablekb)
    {
        $this->disablekb = (int) $disablekb;

        return $this;
    }

    /**
     * @return int
     */
    public function getEnablejsapi()
    {
        return $this->enablejsapi;
    }

    /**
     * @param int $enablejsapi
     *
     * @return VideoEmbedParameters
     */
    public function setEnablejsapi($enablejsapi)
    {
        $this->enablejsapi = (int) $enablejsapi;

        return $this;
    }

    /**
     * @return int
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param int $end
     *
     * @return VideoEmbedParameters
     */
    public function setEnd($end)
    {
        $this->end = (int) $end;

        return $this;
    }

    /**
     * @return int
     */
    public function getFs()
    {
        return $this->fs;
    }

    /**
     * @param int $fs
     *
     * @return VideoEmbedParameters
     */
    public function setFs($fs)
    {
        $this->fs = (int) $fs;

        return $this;
    }

    /**
     * @return string
     */
    public function getHl()
    {
        return $this->hl;
    }

    /**
     * @param string $hl
     *
     * @return VideoEmbedParameters
     */
    public function setHl($hl)
    {
        $this->hl = (string) $hl;

        return $this;
    }

    /**
     * @return int
     */
    public function getIvLoadPolicy()
    {
        return $this->iv_load_policy;
    }

    /**
     * @param int $iv_load_policy
     *
     * @return VideoEmbedParameters
     */
    public function setIvLoadPolicy($iv_load_policy)
    {
        $this->iv_load_policy = (int) $iv_load_policy;

        return $this;
    }

    /**
     * @return string
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param string $list
     *
     * @return VideoEmbedParameters
     */
    public function setList($list)
    {
        $this->list = (string) $list;

        return $this;
    }

    /**
     * @return string
     */
    public function getListType()
    {
        return $this->listType;
    }

    /**
     * @param string $listType
     *
     * @return VideoEmbedParameters
     */
    public function setListType($listType)
    {
        $this->listType = (string) $listType;

        return $this;
    }

    /**
     * @return int
     */
    public function getLoop()
    {
        return $this->loop;
    }

    /**
     * @param int $loop
     *
     * @return VideoEmbedParameters
     */
    public function setLoop($loop)
    {
        $this->loop = (int) $loop;

        return $this;
    }

    /**
     * @return int
     */
    public function getModestbranding()
    {
        return $this->modestbranding;
    }

    /**
     * @param int $modestbranding
     *
     * @return VideoEmbedParameters
     */
    public function setModestbranding($modestbranding)
    {
        $this->modestbranding = (int) $modestbranding;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param string $origin
     *
     * @return VideoEmbedParameters
     */
    public function setOrigin($origin)
    {
        $this->origin = (string) $origin;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }

    /**
     * @param string $playlist
     *
     * @return VideoEmbedParameters
     */
    public function setPlaylist($playlist)
    {
        $this->playlist = (string) $playlist;

        return $this;
    }

    /**
     * @return int
     */
    public function getPlaysinline()
    {
        return $this->playsinline;
    }

    /**
     * @param int $playsinline
     *
     * @return VideoEmbedParameters
     */
    public function setPlaysinline($playsinline)
    {
        $this->playsinline = (int) $playsinline;

        return $this;
    }

    /**
     * @return int
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @param int $rel
     *
     * @return VideoEmbedParameters
     */
    public function setRel($rel)
    {
        $this->rel = (int) $rel;

        return $this;
    }

    /**
     * @return int
     */
    public function getShowinfo()
    {
        return $this->showinfo;
    }

    /**
     * @param int $showinfo
     *
     * @return VideoEmbedParameters
     */
    public function setShowinfo($showinfo)
    {
        $this->showinfo = (int) $showinfo;

        return $this;
    }

    /**
     * @return int
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param int $start
     *
     * @return VideoEmbedParameters
     */
    public function setStart($start)
    {
        $this->start = (int) $start;

        return $this;
    }
}
