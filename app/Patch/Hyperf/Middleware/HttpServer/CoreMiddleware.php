<?php

declare(strict_types=1);

namespace App\Patch\Hyperf\Middleware\HttpServer;

use App\Constants\ErrorCode;
use App\Exception\NoRouteFoundException;
use Psr\Http\Message\ServerRequestInterface;

/**
 * 自定义 CoreMiddleWare 的行为
 * Class CoreMiddleware.
 */
class CoreMiddleware extends \Hyperf\HttpServer\CoreMiddleware
{
    /**
     * Handle the response when cannot found any routes.
     * @throws NoRouteFoundException
     */
    protected function handleNotFound(ServerRequestInterface $request): mixed
    {
        throw new NoRouteFoundException();
    }

    /**
     * Handle the response when the routes found but doesn't match any available methods.
     * @throws NoRouteFoundException
     */
    protected function handleMethodNotAllowed(array $methods, ServerRequestInterface $request): mixed
    {
        $message = ErrorCode::getMessage(ErrorCode::CLIENT_ERROR_NOT_FOUND_ROUTE) . ', allow: ' . implode(',', $methods);
        throw new NoRouteFoundException($message);
    }
}
