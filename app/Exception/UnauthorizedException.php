<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constants\ErrorCode;
use Throwable;

/**
 * 未经授权错误.
 */
class UnauthorizedException extends ClientException
{
    /**
     * UnauthorizedException constructor.
     * @param null $message
     */
    public function __construct($message = null, int $code = ErrorCode::CLIENT_ERROR_UNAUTHORIZED, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = ErrorCode::getMessage($code);
        }
        parent::__construct($message, $code, $previous);
    }
}
