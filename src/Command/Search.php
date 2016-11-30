<?php

namespace Dga\Youtube\Command;

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Description\Operation;

/**
 * https://developers.google.com/youtube/v3/docs/search/list
 *
 * @author    Andras Debreczeni <dev@debreczeniandras.hu>
 */
class Search extends OperationCommand
{
    /**
     * @return Operation
     */
    protected function createOperation()
    {
        return new Operation([
            'name'          => get_class($this),
            'responseClass' => 'Dga\\\Youtube\\Response\\SearchListResponse',
            'uri'           => 'search',
            'httpMethod'    => 'GET',
            'parameters'    => [

                ### REQUIRED PARAMETER
                'part'              => [
                    'location'    => 'query',
                    'description' => 'The part parameter specifies a comma-separated list of one or more video 
                                    resource properties that the API response will include.',
                    'required'    => 'true',
                    'default'     => 'id,snippet',
                    'type'        => 'string',
                ],

                ### FILTERS (specify 0 or 1 of the following parameters)
                'forMine'           => [
                    'location'    => 'query',
                    'description' => 'This parameter can only be used in a properly authorized request. 
                                    The forMine parameter restricts the search to only retrieve videos owned by the 
                                    authenticated user. If you set this parameter to true, then the type parameter\'s 
                                    value must also be set to video.',
                    'type'        => 'string',
                ],
                'forContentOwner'   => [
                    'location'    => 'query',
                    'description' => 'This parameter can only be used in a properly authorized request. Note: This 
                                    parameter is intended exclusively for YouTube content partners.

                                    The forContentOwner parameter restricts the search to only retrieve resources owned 
                                    by the content owner specified by the onBehalfOfContentOwner parameter. The user 
                                    must be authenticated using a CMS account linked to the specified content owner and 
                                    onBehalfOfContentOwner must be provided.',
                    'type'        => 'boolean',
                ],
                'relatedToVideoId'  => [
                    'location'    => 'query',
                    'description' => 'The relatedToVideoId parameter retrieves a list of videos that are related to the 
                                    video that the parameter value identifies. The parameter value must be set to a 
                                    YouTube video ID and, if you are using this parameter, the type parameter 
                                    must be set to video.

                                    Note that if the relatedToVideoId parameter is set, the only other supported 
                                    parameters are part, maxResults, pageToken, regionCode, relevanceLanguage, 
                                    safeSearch, type (which must be set to video), and fields.',
                    'type'        => 'string',
                ],

                ### OPTIONAL FILTERS
                'channelId'         => [
                    'location'    => 'query',
                    'description' => 'The channelId parameter indicates that the API response should only contain 
                                    resources created by the channel.

                                    Note: Search results are constrained to a maximum of 500 videos if your request 
                                    specifies a value for the channelId parameter and sets the type parameter value to 
                                    video, but it does not also set one of the forContentOwner, forDeveloper, 
                                    or forMine filters.',
                    'type'        => 'string',
                ],
                'eventType'         => [
                    'location'    => 'query',
                    'description' => 'The eventType parameter restricts a search to broadcast events. If you specify    
                                    a value for this parameter, you must also set the type parameter\'s value to video.
                                    Acceptable values are:
                                    - completed 
                                        Only include completed broadcasts.
                                    - live 
                                        Only include active broadcasts.
                                    - upcoming 
                                        Only include upcoming broadcasts',
                    'type'        => 'string',
                ],
                'location'          => [
                    'location'    => 'query',
                    'description' => 'The location parameter, in conjunction with the locationRadius parameter, 
                                    defines a circular geographic area and also restricts a search to videos that 
                                    specify, in their metadata, a geographic location that falls within that area. 
                                    The parameter value is a string that specifies latitude/longitude coordinates e.g. 
                                    (37.42307,-122.08427).

                                    The location parameter value identifies the point at the center of the area.
                                    The locationRadius parameter specifies the maximum distance that the location 
                                    associated with a video can be from that point for the video to still be included 
                                    in the search results.
                                
                                    The API returns an error if your request specifies a value for the location 
                                    parameter but does not also specify a value for the locationRadius parameter.',
                    'type'        => 'string',
                ],
                'locationRadius'    => [
                    'location'    => 'query',
                    'description' => 'The locationRadius parameter, in conjunction with the location parameter, 
                                    defines a circular geographic area.

                                    The parameter value must be a floating point number followed by a measurement unit. 
                                    Valid measurement units are m, km, ft, and mi. For example, valid parameter values 
                                    include 1500m, 5km, 10000ft, and 0.75mi. The API does not support locationRadius 
                                    parameter values larger than 1000 kilometers.',
                    'type'        => 'string',
                ],
                'maxResults'        => [
                    'location'    => 'query',
                    'description' => 'The maxResults parameter specifies the maximum number of items that should 
                                    be returned in the result set.

                                    Note: This parameter is supported for use in conjunction with the myRating 
                                    parameter, but it is not supported for use in conjunction with the id parameter. 
                                    Acceptable values are 1 to 50, inclusive. The default value is 5.',
                    'type'        => 'integer',
                ],
                'order'             => [
                    'location'    => 'query',
                    'description' => 'The order parameter specifies the method that will be used to order resources 
                                    in the API response. The default value is relevance.
                                    
                                    Acceptable values are:
                                    - date 
                                        Resources are sorted in reverse chronological order based on the date 
                                        they were created.
                                    - rating 
                                        Resources are sorted from highest to lowest rating.
                                    - relevance 
                                        Resources are sorted based on their relevance to the search query. 
                                        This is the default value for this parameter.
                                    - title 
                                        Resources are sorted alphabetically by title.
                                    - videoCount 
                                        Channels are sorted in descending order of their number of uploaded videos.
                                    - viewCount 
                                        Resources are sorted from highest to lowest number of views. For live
                                        broadcasts, videos are sorted by number of concurrent viewers 
                                        while the broadcasts are ongoing.',
                    'type'        => 'string',
                ],
                'pageToken'         => [
                    'location'    => 'query',
                    'description' => 'The pageToken parameter identifies a specific page in the result set that should 
                                    be returned. In an API response, the nextPageToken and prevPageToken properties 
                                    identify other pages that could be retrieved.',
                    'type'        => 'string',
                ],
                'publishedAfter'    => [
                    'location'    => 'query',
                    'description' => 'The publishedAfter parameter indicates that the API response should only contain 
                                    resources created at or after the specified time. The value is an RFC 3339 
                                    formatted date-time value (1970-01-01T00:00:00Z).',
                    'type'        => 'string',
                ],
                'publishedBefore'   => [
                    'location'    => 'query',
                    'description' => 'The publishedBefore parameter indicates that the API response should only contain 
                                    resources created before or at the specified time. The value is an RFC 3339 
                                    formatted date-time value (1970-01-01T00:00:00Z).',
                    'type'        => 'string',
                ],
                'q'                 => [
                    'location'    => 'query',
                    'description' => 'The q parameter specifies the query term to search for.
                                    Your request can also use the Boolean NOT (-) and OR (|) operators to exclude 
                                    videos or to find videos that are associated with one of several search terms. 
                                    For example, to search for videos matching either "boating" or "sailing", set the q 
                                    parameter value to boating|sailing. Similarly, to search for videos matching either 
                                    "boating" or "sailing" but not "fishing", set the q parameter value to 
                                    boating|sailing -fishing. Note that the pipe character must be URL-escaped when 
                                    it is sent in your API request. 
                                    The URL-escaped value for the pipe character is %7C.',
                    'type'        => 'string',
                ],
                'regionCode'        => [
                    'location'    => 'query',
                    'description' => 'The regionCode parameter instructs the API to select a video chart available 
                                    in the specified region. This parameter can only be used in conjunction with the 
                                    chart parameter. The parameter value is an ISO 3166-1 alpha-2 country code.',
                    'type'        => 'string',
                ],
                'relevanceLanguage' => [
                    'location'    => 'query',
                    'description' => 'The relevanceLanguage parameter instructs the API to return search results that 
                                    are most relevant to the specified language. The parameter value is typically an 
                                    ISO 639-1 two-letter language code. However, you should use the values zh-Hans for 
                                    simplified Chinese and zh-Hant for traditional Chinese. Please note that results 
                                    in other languages will still be returned if they are highly relevant to the 
                                    search query term.',
                    'type'        => 'string',
                ],
                'topicId'           => [
                    'location'    => 'query',
                    'description' => 'The topicId parameter indicates that the API response should only contain 
                                    resources associated with the specified topic. The value identifies 
                                    a Freebase topic ID.

                                    Important: Due to the deprecation of Freebase and the Freebase API, the topicId 
                                    parameter will start working differently as of February 10, 2017. At that time, 
                                    YouTube will start returning a small set of topic IDs instead of the much more 
                                    granular set of IDs returned now, and you will only be able to use that smaller 
                                    set of IDs as values for this parameter. YouTube will publish that list of topic 
                                    IDs by November 10, 2016. See the revision history for more details 
                                    about this change.',
                    'type'        => 'string',
                ],
                'type'              => [
                    'location'    => 'query',
                    'description' => 'The type parameter restricts a search query to only retrieve a particular type of 
                                    resource. The value is a comma-separated list of resource types. 
                                    The default value is video,channel,playlist.
                                    Acceptable values are: 
                                    "channel", "playlist", "video"',
                    'type'        => 'string',
                    'default'     => 'video'
                ],
                'videoCaption'      => [
                    'location'    => 'query',
                    'description' => 'The videoCaption parameter indicates whether the API should filter video search 
                                    results based on whether they have captions. If you specify a value for this 
                                    parameter, you must also set the type parameter\'s value to video.
                                    
                                    Acceptable values are:
                                    - any 
                                        Do not filter results based on caption availability.
                                    - closedCaption 
                                        Only include videos that have captions.
                                    - none 
                                        Only include videos that do not have captions.',
                    'type'        => 'string',
                ],
                'videoCategoryId'   => [
                    'location'    => 'query',
                    'description' => 'The videoCategoryId parameter identifies the video category for which the chart 
                                    should be retrieved. This parameter can only be used in conjunction with the chart 
                                    parameter. By default, charts are not restricted to a particular category. 
                                    The default value is 0.',
                    'type'        => 'string',
                ],
                'videoDuration'     => [
                    'location'    => 'query',
                    'description' => 'The videoDuration parameter filters video search results based on their duration. 
                                    If you specify a value for this parameter, you must also set the 
                                    type parameter\'s value to video.

                                    Acceptable values are:
                                    - any 
                                        Do not filter video search results based on their duration. This is default.
                                    - long 
                                        Only include videos longer than 20 minutes.
                                    - medium 
                                        Only include videos that are between four and 20 minutes long (inclusive).
                                    - short 
                                        Only include videos that are less than four minutes long.',
                    'type'        => 'string',
                ],
                'videoEmbeddable'   => [
                    'location'    => 'query',
                    'description' => 'The videoEmbeddable parameter lets you to restrict a search to only videos that 
                                    can be embedded into a webpage. If you specify a value for this parameter, you must 
                                    also set the type parameter\'s value to video.

                                    Acceptable values are:
                                    - any 
                                        Return all videos, embeddable or not.
                                    - true 
                                        Only retrieve embeddable videos.',
                    'type'        => 'string',
                ],
            ]
        ]);
    }
}
