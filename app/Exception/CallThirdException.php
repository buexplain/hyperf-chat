<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constants\ErrorCode;
use Throwable;

/**
 * 第三方接口错误.
 */
class CallThirdException extends ServerException
{
    /**
     * 第三方地址
     */
    protected string $thirdUrl = '';

    /**
     * 第三方code.
     * @var int
     */
    protected int $thirdCode = -1;

    /**
     * 第三方返回消息.
     * @var string
     */
    protected string $thirdMessage = '';

    /**
     * 请求三方的上下文.
     * @var array
     */
    protected array $thirdContext = [];

    /**
     * CallThirdException constructor.
     */
    public function __construct(string $url, string $message = null, int $code = null, Throwable $previous = null, array $context = [])
    {
        $this->thirdUrl = $url;
        if (is_null($message)) {
            $message = ErrorCode::getMessage(ErrorCode::SERVER_CALL_THIRD);
        } else {
            $this->thirdMessage = $message;
        }
        if (! is_null($code)) {
            $this->thirdCode = $code;
            $message = sprintf('%s [%s] [%s]', $message, $url, $code);
        } else {
            $message = sprintf('%s [%s]', $message, $url);
        }
        $this->thirdContext = $context;
        parent::__construct($message, ErrorCode::SERVER_CALL_THIRD, $previous);
    }

    public function getThirdURL(): string
    {
        return $this->thirdUrl;
    }

    public function getThirdCode(): int
    {
        return $this->thirdCode;
    }

    public function getThirdMessage(): string
    {
        return $this->thirdMessage;
    }

    public function getThirdContext(): array
    {
        return $this->thirdContext;
    }
}
