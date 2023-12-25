<?php

declare(strict_types=1);

namespace App\Patch\Logger;

use Hyperf\Context\ApplicationContext;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Monolog\Level;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

/**
 * Class StdLogger.
 */
class StdLogger
{
    /**
     * Detailed debug information.
     */
    public const DEBUG = Level::Debug;

    /**
     * Interesting events.
     *
     * Examples: User logs in, SQL logs.
     */
    public const INFO = Level::Info;

    /**
     * Uncommon events.
     */
    public const NOTICE = Level::Notice;

    /**
     * Exceptional occurrences that are not errors.
     *
     * Examples: Use of deprecated APIs, poor use of an API,
     * undesirable things that are not necessarily wrong.
     */
    public const WARNING = Level::Warning;

    /**
     * Runtime errors.
     */
    public const ERROR = Level::Error;

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     */
    public const CRITICAL = Level::Critical;

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc.
     * This should trigger the SMS alerts and wake you up.
     */
    public const ALERT = Level::Alert;

    /**
     * Urgent alert.
     */
    public const EMERGENCY = Level::Emergency;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getInstance(): StdoutLoggerInterface
    {
        $container = ApplicationContext::getContainer();
        return $container->get(StdoutLoggerInterface::class);
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function emergency(string $message, array $context = []): void
    {
        self::getInstance()->emergency($message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function alert(string $message, array $context = []): void
    {
        self::getInstance()->alert($message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function critical(string $message, array $context = []): void
    {
        self::getInstance()->critical($message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function error(string $message, array $context = []): void
    {
        self::getInstance()->error($message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function warning(string $message, array $context = []): void
    {
        self::getInstance()->warning($message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function notice(string $message, array $context = []): void
    {
        self::getInstance()->notice($message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     */
    public static function info(string $message, array $context = []): void
    {
        try {
            self::getInstance()->info($message, $context);
        } catch (Throwable) {
        }
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     */
    public static function debug(string $message, array $context = []): void
    {
        try {
            self::getInstance()->debug($message, $context);
        } catch (Throwable) {
        }
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function throwable(Throwable $throwable): void
    {
        $formatter = ApplicationContext::getContainer()->get(FormatterInterface::class);
        self::error($formatter->format($throwable));
    }
}
