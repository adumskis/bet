<?php

namespace App\Http\Middleware;

use App\Exceptions\ValidationException;
use App\Services\Validation\PreviousActionNotFinishedError;
use Closure;
use Illuminate\Cache\CacheManager;
use Illuminate\Http\Request;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * Class OncePerPlayerMiddleware
 * @package App\Http\Middleware
 */
class OncePerPlayerMiddleware
{
    const TTL = 30;

    /**
     * @var CacheManager
     */
    protected $cacheManager;

    /**
     * OncePerPlayerMiddleware constructor.
     * @param CacheManager $cacheManager
     */
    public function __construct(CacheManager $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws ValidationException
     * @throws InvalidArgumentException
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->getPlayerId($request)) {
            return $next($request);
        }

        $cacheKey = $this->getCacheKey($request);
        $this->checkRunningRequest($cacheKey);
        $this->cacheManager->set($cacheKey, true, self::TTL);

        $response = $next($request);

        $this->cacheManager->delete($cacheKey);

        return $response;
    }

    /**
     * @param Request $request
     * @return string
     */
    protected function getCacheKey(Request $request): string
    {
        $prefix = $this->getPrefix($request);
        $playerId = $this->getPlayerId($request);

        return "{$playerId}:{$prefix}";
    }

    /**
     * @param Request $request
     * @return string|null
     */
    protected function getPlayerId(Request $request): ?string
    {
        return $playerId = $request->get('player_id');
    }

    /**
     * @param Request $request
     * @return string
     */
    protected function getPrefix(Request $request): string
    {
        return $request->getRequestUri();
    }

    /**
     * @param string $cacheKey
     * @throws ValidationException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function checkRunningRequest(string $cacheKey): void
    {
        if ($this->cacheManager->has($cacheKey)) {
            throw new ValidationException([new PreviousActionNotFinishedError()]);
        }
    }
}
