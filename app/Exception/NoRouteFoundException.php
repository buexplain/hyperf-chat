<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constants\ErrorCode;
use Throwable;

/**
 *  请求地址错误.
 */
class NoRouteFoundException extends ClientException
{
    /**
     * NoRouteFoundException constructor.
     * @param null $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = null, int $code = ErrorCode::CLIENT_ERROR_NOT_FOUND_ROUTE, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = ErrorCode::getMessage($code);
        }
        parent::__construct($message, $code, $previous);
    }
}
