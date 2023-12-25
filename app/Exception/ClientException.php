<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constants\ErrorCode;
use Hyperf\Server\Exception\ServerException;
use Throwable;

/**
 * 客户端错误
 * Class ClientException.
 */
class ClientException extends ServerException
{
    /**
     * ClientException constructor.
     * @param null $message
     */
    public function __construct($message = null, int $code = ErrorCode::CLIENT_ERROR, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = ErrorCode::getMessage($code);
        }
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param array|string $err 错误码与说明的map或者是具体的错误信息
     * @param int $code
     * @return static
     */
    public static function make(array|string $err, int $code): static
    {
        if (is_array($err)) {
            return new static($err[$code], $code);
        }
        return new static($err, $code);
    }
}
