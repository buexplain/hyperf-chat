<?php

declare(strict_types=1);

namespace App\Dao;

use ReflectionClass;

class EnvDao
{
    /**
     * 反射所有的日志配置
     * @return array
     */
    public static function getLogs(): array
    {
        $objClass = new ReflectionClass(__CLASS__);
        $logs = [];
        foreach ($objClass->getConstants() as $name => $value) {
            if (str_starts_with($name, 'LOG_')) {
                $logs[] = $value;
            }
        }
        return $logs;
    }

    /**
     * 本工程默认的日志.
     */
    public const LOG_DEFAULT = 'hyperf';

    /**
     * 本工程默认的sql日志.
     */
    public const LOG_SQL = 'sql';
}