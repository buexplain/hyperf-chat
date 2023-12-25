<?php

declare (strict_types=1);

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @method static string getMessage(int|string $code, array $translate = null)
 */
#[Constants]
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("成功")
     */
    const SUCCESS = 0;
    /**
     * @Message("第三方接口错误")
     */
    const SERVER_CALL_THIRD = 501;
    /**
     *  > = 500
     * @Message("服务端错误")
     */
    const SERVER_ERROR = 500;
    /**
     * 1 ~ 400
     * @Message("客户端错误")
     */
    const CLIENT_ERROR = 400;
    /**
     * @Message("未找到相关信息")
     */
    const CLIENT_ERROR_NOT_FOUND_DATA = 399;
    /**
     * @Message("客户端参数错误")
     */
    const CLIENT_INVALID_ARGUMENT = 398;
    /**
     * @Message("请求地址错误")
     */
    const CLIENT_ERROR_NOT_FOUND_ROUTE = 397;
    /**
     * @Message("请求未授权")
     */
    const CLIENT_ERROR_UNAUTHORIZED = 396;
    /**
     * @Message("无效的token")
     */
    const CLIENT_INVALID_TOKEN = 395;
    /**
     * @Message("csrf token 校验失败，请刷新页面重试")
     */
    const CLIENT_CSRF = 394;
}