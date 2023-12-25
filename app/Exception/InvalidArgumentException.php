<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constants\ErrorCode;
use Exception;
use Throwable;

/**
 *  客户端参数错误.
 */
class InvalidArgumentException extends ClientException
{
    /**
     * InvalidArgumentException constructor.
     * @param null|string $message 参数名称或自定义提示信息
     * @param null|Exception $previous
     */
    public function __construct($message = null, int $code = ErrorCode::CLIENT_INVALID_ARGUMENT, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = ErrorCode::getMessage($code);
        } elseif (preg_match('~^[a-zA-Z][a-zA-Z0-9_]*$~', $message) > 0) {
            $message = ErrorCode::getMessage($code) . '：' . $message;
        }
        parent::__construct($message, $code, $previous);
    }
}
