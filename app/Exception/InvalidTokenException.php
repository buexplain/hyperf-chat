<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constants\ErrorCode;
use Throwable;

/**
 *  无效的token.
 */
class InvalidTokenException extends ClientException
{
    /**
     * InvalidTokenException constructor.
     * @param null|string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string|null $message = null, int $code = ErrorCode::CLIENT_INVALID_TOKEN, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = ErrorCode::getMessage($code);
        }
        parent::__construct($message, $code, $previous);
    }
}
