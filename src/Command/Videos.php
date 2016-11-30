<?php

namespace Dga\Youtube\Command;

use Dga\Youtube\Resource\Video;
use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Description\Operation;

/**
 * https://developers.google.com/youtube/v3/docs/videos/list
 *
 * @author    Andras Debreczeni <gitlab@debreczeniandras.hu>
 */
class Videos extends OperationCommand
{
    /**
     * @return Operation
     */
    protected function createOperation()
    {
        return new Operation([
            'name'          => get_class($this),
            'responseClass' => 'Dga\\\Youtube\\Response\\VideoListResponse',
            'uri'           => 'videos',
            'httpMethod'    => 'GET',
            'parameters'    => [
                'part'            => [
                    'location'    => 'query',
                    'description' => 'The part parameter specifies a comma-separated list of one or more video 
                                    resource properties that the API response will include.',
                    'required'    => 'true',
                    'default'     => 'id,snippet,player',
                    'type'        => 'string',
                ],
                'id'              => [
                    'location'    => 'query',
                    'description' => 'The id parameter specifies a comma-separated list of the YouTube video ID(s) 
                                    for the resource(s) that are being retrieved. In a video resource, 
                                    the id property specifies the video\'s ID.',
                    'type'        => 'string',
                ],
                'chart'           => [
                    'location'    => 'query',
                    'description' => 'The chart parameter identifies the chart that you want to retrieve',
                    'type'        => 'string',
                ],
                'maxHeight'       => [
                    'location'    => 'query',
                    'description' => 'The maxHeight parameter specifies the maximum height of the embedded player 
                                    returned in the player.embedHtml property. You can use this parameter to specify 
                                    that instead of the default dimensions, the embed code should use a height 
                                    appropriate for your application layout. If the maxWidth parameter is also 
                                    provided, the player may be shorter than the maxHeight in order to not violate 
                                    the maximum width. Acceptable values are 72 to 8192, inclusive.',
                    'type'        => 'integer',
                    'default'     => Video::DEFAULT_HEIGHT,
                ],
                'maxWidth'        => [
                    'location'    => 'query',
                    'description' => 'The maxWidth parameter specifies the maximum width of the embedded player
                                    returned in the player.embedHtml property. You can use this parameter to specify
                                    that instead of the default dimensions, the embed code should use a 
                                    width appropriate for your application layout.

                                    If the maxHeight parameter is also provided, the player may be narrower than 
                                    maxWidth in order to not violate the maximum height. Acceptable values are 
                                    72 to 8192, inclusive.',
                    'type'        => 'integer',
                    'default'     => Video::DEFAULT_WIDTH,
                ],
                'maxResults'      => [
                    'location'    => 'query',
                    'description' => 'The maxResults parameter specifies the maximum number of items that should 
                                    be returned in the result set.

                                    Note: This parameter is supported for use in conjunction with the myRating 
                                    parameter, but it is not supported for use in conjunction with the id parameter. 
                                    Acceptable values are 1 to 50, inclusive. The default value is 5.',
                    'type'        => 'integer',
                ],
                'regionCode'      => [
                    'location'    => 'query',
                    'description' => 'The regionCode parameter instructs the API to select a video chart available 
                                    in the specified region. This parameter can only be used in conjunction with the 
                                    chart parameter. The parameter value is an ISO 3166-1 alpha-2 country code.',
                    'type'        => 'string',
                ],
                'videoCategoryId' => [
                    'location'    => 'query',
                    'description' => 'The videoCategoryId parameter identifies the video category for which the chart 
                                    should be retrieved. This parameter can only be used in conjunction with the chart 
                                    parameter. By default, charts are not restricted to a particular category. 
                                    The default value is 0.',
                    'type'        => 'string',
                ],
            ]
        ]);
    }
}
