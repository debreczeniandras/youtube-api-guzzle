<?php

namespace Dga\Youtube;

use CommerceGuys\Guzzle\Plugin\Oauth2;
use Dga\Youtube\Response\PlayListResponse;
use Dga\Youtube\Response\SearchListResponse;
use Dga\Youtube\Response\VideoListResponse;
use Guzzle\Service;
use Guzzle\Http;
use Guzzle\Common\Collection;

/**
 * @method VideoListResponse    Videos(array $parameters)
 * @method SearchListResponse   Search(array $parameters)
 * @method PlayListResponse     Playlists(array $parameters)
 *
 * @author Andras Debreczeni <dev@debreczeniandras.hu>
 */
class Youtube extends Service\Client
{
    /**
     * @param array $params
     *
     * @return Youtube
     */
    public static function factory($params = [])
    {
        $required = ['base_url', 'client_id', 'client_secret', 'token_uri', 'refresh_token'];

        $config = Collection::fromConfig($params, [], $required);
        $config->set('curl.options', [CURLOPT_PROXY => getenv('HTTPS_PROXY'), CURLOPT_TIMEOUT => 30]);

        $client = new self($config->get('base_url'), $config);

        // The refresh grant type needs its own client
        $refreshClient    = new Http\Client($config->get('token_uri'), $config);
        $refreshGrantType = new Oauth2\GrantType\RefreshToken($refreshClient, $config->toArray());

        // add refresh strategy
        $client->addSubscriber(new Oauth2\Oauth2Plugin($refreshGrantType));

        return $client;
    }
}
