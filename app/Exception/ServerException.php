<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constants\ErrorCode;
use Hyperf\Server\Exception\ServerException as BaseServerException;
use Throwable;

/**
 * 服务端错误.
 */
class ServerException extends BaseServerException
{
    /**
     * ServerException constructor.
     * @param null $message
     */
    public function __construct($message = null, int $code = ErrorCode::SERVER_ERROR, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = ErrorCode::getMessage($code);
        }
        parent::__construct($message, $code, $previous);
    }
}
