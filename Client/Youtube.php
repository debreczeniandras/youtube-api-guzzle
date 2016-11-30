<?php

namespace Swatch\TvBundle\Client;

use CommerceGuys\GuzzleHttp\Plugin\Oauth2;
use Doctrine\Common\Cache\PredisCache;
use GuzzleHttp\Plugin\Cache\CachePlugin;
use GuzzleHttp\Plugin\Cache\DefaultCacheStorage;
use GuzzleHttp\Service;
use GuzzleHttp\Http;
use GuzzleHttp\Common\Collection;
use Predis\Client;
use Swatch\TvBundle\Type\Youtube\PlayListResponse;
use Swatch\TvBundle\Type\Youtube\SearchListResponse;
use Swatch\TvBundle\Type\Youtube\VideoListResponse;

/**
 * @method VideoListResponse    Videos(array $parameters)
 * @method SearchListResponse   Search(array $parameters)
 * @method PlayListResponse     Playlists(array $parameters)
 *
 * @author    Andras Debreczeni <andras.debreczeni@db-n.com>
 * @copyright 2016 deepblue networks AG
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
        $required = ['base_url', 'client_id', 'client_secret', 'token_uri', 'refresh_token', 'redis_dsn'];

        $config = Collection::fromConfig($params, [], $required);
        $config->set('curl.options', [CURLOPT_PROXY => getenv('HTTPS_PROXY'), CURLOPT_TIMEOUT => 30]);

        $client = new self($config->get('base_url'), $config);

        // The refresh grant type needs its own client
        $refreshClient    = new Http\Client($config->get('token_uri'), $config);
        $refreshGrantType = new Oauth2\GrantType\RefreshToken($refreshClient, $config->toArray());

        // add refresh strategy
        $client->addSubscriber(new Oauth2\Oauth2Plugin($refreshGrantType));

        // add caching strategy
        $redisUrlParams = parse_url($config->get('redis_dsn'));
        unset($redisUrlParams['scheme']);

        $predisClient = new Client($redisUrlParams);
        $predisCache  = new PredisCache($predisClient);
        $cachePlugin  = new CachePlugin(['storage' => new DefaultCacheStorage($predisCache)]);

        $client->addSubscriber($cachePlugin);

//        $logAdapter = new PsrLogAdapter(new Logger('youtube'));
//        $logging = new LogPlugin($logAdapter);
//        $client->addSubscriber($logging);

        return $client;
    }
}
