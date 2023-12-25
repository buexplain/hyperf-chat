<?php

declare(strict_types=1);

namespace App\Exception\Formatter;

use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Throwable;

class DefaultFormatter implements FormatterInterface
{
    public function format(Throwable $throwable): string
    {
        return self::fullFormat($throwable);
    }

    public static function fullFormat(Throwable $throwable): string
    {
        $message = $throwable->getMessage();
        $message = trim($message);
        if (strlen($message) == 0) {
            $message = get_class($throwable);
        }
        return sprintf(
            "%d --> %s in %s on line %d\nThrowable: %s\nStack trace:\n%s",
            $throwable->getCode(),
            $message,
            $throwable->getFile(),
            $throwable->getLine(),
            get_class($throwable),
            $throwable->getTraceAsString()
        );
    }

    public static function simpleFormat(Throwable $throwable): string
    {
        $message = $throwable->getMessage();
        $message = trim($message);
        if (strlen($message) == 0) {
            $message = get_class($throwable);
        }
        return sprintf(
            "%d --> %s in %s on line %d\nThrowable: %s",
            $throwable->getCode(),
            $message,
            $throwable->getFile(),
            $throwable->getLine(),
            get_class($throwable),
        );
    }
}
