<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @see     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use App\Exception\Formatter\DefaultFormatter;
use App\Patch\Hyperf\StdoutLogger\StdoutLoggerFactory;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\Formatter\FormatterInterface;

return (function () {
    $ret = [
        // 自定义 CoreMiddleWare 的行为
        Hyperf\HttpServer\CoreMiddleware::class => App\Patch\Hyperf\Middleware\HttpServer\CoreMiddleware::class,
        // 自定义 异常格式化
        FormatterInterface::class => DefaultFormatter::class,
    ];
    // 自定义控制台日志到日志文件，如此一来，框架底层的打印到控制台的error日志都会被记录到日志文件
    if (\Hyperf\Support\env('APP_ENV') !== 'dev') {
        $ret[StdoutLoggerInterface::class] = StdoutLoggerFactory::class;
    }
    return $ret;
})();
