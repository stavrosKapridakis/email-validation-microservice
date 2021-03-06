<?php

namespace App\Providers\Cache;

use App\Http\Contracts\CacheInterface;
use App\Http\Models\LogExceptions;
use Redis;

/**
 * Class RedisCache
 *
 * @package App\Providers\Cache
 */
class RedisCache implements CacheInterface
{
    /**
     * @var Redis
     */
    private $redis;

    /**
     * Throwable
     */
    const EXCEPTION_TYPE = 'redis_initialization_failure';

    /**
     * RedisCache constructor.
     */
    public function __construct()
    {
        $this->initializeRedis();
    }

    /**
     * Retrieve from cache item
     * if present
     *
     * @param string $key
     * @return bool|string
     */
    public function get(string $key)
    {
        return $this->redis->get($key);
    }

    /**
     * Store in cache an item
     *
     * @param string $key
     * @param string $value
     * @param int $ttl
     * @return mixed|void
     */
    public function set(string $key, string $value, $ttl = 10)
    {
        $this->redis->set($key, $value, $ttl);
    }

    /**
     * Initialize Redis Cache
     *
     * @return void
     */
    public function initializeRedis()
    {
        try {
            //create redis instance
            $this->redis = new Redis();
            //connect with server and port
            $this->redis->connect(
                config('cache.stores.redis.servers.host'),
                config('cache.stores.redis.servers.port')
            );
        } catch (\Throwable $e) {
            LogExceptions::log($e, self::EXCEPTION_TYPE);

            $this->redis = false;
        }
    }
}
