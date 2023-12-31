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

use App\Dao\EnvDao;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;

return (function () {
    $ret = [];
    foreach (EnvDao::getLogs() as $log) {
        $ret[$log] = [
            'handlers' => [
                [
                    'class' => RotatingFileHandler::class,
                    'constructor' => [
                        'filename' => BASE_PATH . '/runtime/logs/' . $log . '.log',
                        'level' => Level::Info,
                        'bubble' => true,
                    ],
                    'formatter' => [
                        'class' => LineFormatter::class,
                        'constructor' => [
                            'format' => null,
                            'dateFormat' => 'Y-m-d H:i:s',
                            'allowInlineLineBreaks' => true,
                        ],
                    ],
                ],
            ],
        ];
    }
    return $ret;
})();
