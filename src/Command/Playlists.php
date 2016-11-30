<?php

namespace Dga\Youtube\Command;

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Description\Operation;

/**
 * https://developers.google.com/youtube/v3/docs/videos/list
 *
 * @author    Andras Debreczeni <dev@debreczeniandras.hu>
 */
class Playlists extends OperationCommand
{
    /**
     * @return Operation
     */
    protected function createOperation()
    {
        return new Operation([
            'name'          => get_class($this),
            'responseClass' => 'Dga\\Youtube\\Response\\PlayListResponse',
            'uri'           => 'playlists',
            'httpMethod'    => 'GET',
            'parameters'    => [

                // REQUIRED

                'part' => [
                    'location'    => 'query',
                    'description' => 'The part parameter specifies a comma-separated list of one or more video 
                                    resource properties that the API response will include.',
                    'required'    => 'true',
                    'default'     => 'id,snippet,player',
                    'type'        => 'string',
                ],

                // FILTERS (specify exactly one of the following parameters)

                'channelId' => [
                    'location'    => 'query',
                    'description' => 'The channelId parameter indicates that the API response should only contain 
                                    resources created by the channel.

                                    Note: Search results are constrained to a maximum of 500 videos if your request 
                                    specifies a value for the channelId parameter and sets the type parameter value to 
                                    video, but it does not also set one of the forContentOwner, forDeveloper, 
                                    or forMine filters.',
                    'type'        => 'string'
                ],
                'id'        => [
                    'location'    => 'query',
                    'description' => 'The id parameter specifies a comma-separated list of the YouTube video ID(s) 
                                    for the resource(s) that are being retrieved. In a video resource, 
                                    the id property specifies the video\'s ID.',
                    'type'        => 'string',
                ],
                'mine'      => [
                    'location'    => 'query',
                    'description' => 'This parameter can only be used in a properly authorized request. Set this 
                                    parameter\'s value to true to instruct the API to only return playlists owned by 
                                    the authenticated user',
                    'type'        => 'boolean',
                ],

                // OPTIONAL PARAMETERS

                'hl'                            => [
                    'location'    => 'query',
                    'description' => 'The hl parameter instructs the API to retrieve localized resource metadata for a 
                                    specific application language that the YouTube website supports. The parameter 
                                    value must be a language code included in the list returned by the 
                                    i18nLanguages.list method.

                                    If localized resource details are available in that language, the resource\'s 
                                    snippet.localized object will contain the localized values. However, if localized 
                                    details are not available, the snippet.localized object will contain resource 
                                    details in the resource\'s default language.',
                    'type'        => 'string',
                ],
                'maxResults'                    => [
                    'location'    => 'query',
                    'description' => 'The maxResults parameter specifies the maximum number of items that should 
                                    be returned in the result set.

                                    Note: This parameter is supported for use in conjunction with the myRating 
                                    parameter, but it is not supported for use in conjunction with the id parameter. 
                                    Acceptable values are 1 to 50, inclusive. The default value is 5.',
                    'type'        => 'integer',
                ],
                'onBehalfOfContentOwner'        => [
                    'location'    => 'query',
                    'description' => 'This parameter can only be used in a properly authorized request. Note: This 
                                    parameter is intended exclusively for YouTube content partners.

                                    The onBehalfOfContentOwner parameter indicates that the request\'s authorization 
                                    credentials identify a YouTube CMS user who is acting on behalf of the content 
                                    owner specified in the parameter value. This parameter is intended for YouTube
                                    content partners that own and manage many different YouTube channels. It allows 
                                    content owners to authenticate once and get access to all their video and channel 
                                    data, without having to provide authentication credentials for each individual 
                                    channel. The CMS account that the user authenticates with must be linked to the 
                                    specified YouTube content owner.',
                    'type'        => 'string',
                ],
                'onBehalfOfContentOwnerChannel' => [
                    'location'    => 'query',
                    'description' => 'This parameter can only be used in a properly authorized request. Note: This 
                                    parameter is intended exclusively for YouTube content partners.

                                    The onBehalfOfContentOwnerChannel parameter specifies the YouTube channel ID of 
                                    the channel to which a video is being added. This parameter is required when a 
                                    request specifies a value for the onBehalfOfContentOwner parameter, and it can only 
                                    be used in conjunction with that parameter. In addition, the request must be 
                                    authorized using a CMS account that is linked to the content owner that the 
                                    onBehalfOfContentOwner parameter specifies. Finally, the channel that the 
                                    onBehalfOfContentOwnerChannel parameter value specifies must be linked to the 
                                    content owner that the onBehalfOfContentOwner parameter specifies.

                                    This parameter is intended for YouTube content partners that own and manage many 
                                    different YouTube channels. It allows content owners to authenticate once and 
                                    perform actions on behalf of the channel specified in the parameter value, without 
                                    having to provide authentication credentials for each separate channel.',
                    'type'        => 'string',
                ],
                'pageToken'                     => [
                    'location'    => 'query',
                    'description' => 'The pageToken parameter identifies a specific page in the result set that should 
                                    be returned. In an API response, the nextPageToken and prevPageToken properties 
                                    identify other pages that could be retrieved.',
                    'type'        => 'string',
                ],
            ]
        ]);
    }
}
