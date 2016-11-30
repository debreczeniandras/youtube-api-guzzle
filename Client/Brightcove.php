<?php

namespace Swatch\TvBundle\Client;

use CommerceGuys\Guzzle\Plugin\Oauth2;
use Guzzle\Service;
use Guzzle\Http;
use Guzzle\Common\Collection;

/**
 * @author    Andras Debreczeni <andras.debreczeni@db-n.com>
 * @copyright 2016 deepblue networks AG
 */
class Brightcove extends Service\Client
{
    /**
     * @param array $params
     *
     * @return Brightcove
     */
    public static function factory($params = [])
    {
        $required = ['base_url', 'client_id', 'client_secret', 'account_id', 'oauth_base_url'];
        $config   = Collection::fromConfig($params, [], $required);

        // the default client
        $client = new self($config->get('base_url'), $config);

        // the client for the oauth plugin
        $oauthClient = new Http\Client($config->get('oauth_base_url'));
        $grantType   = new Oauth2\GrantType\ClientCredentials($oauthClient, $config->toArray());

        $client->addSubscriber(new Oauth2\Oauth2Plugin($grantType));

//        $client->addSubscriber(new CachePlugin())

        return $client;
    }
}
