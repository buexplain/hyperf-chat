<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use App\Constants\ErrorCode;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    #[Inject]
    protected ContainerInterface $container;

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;

    /**
     * 返回成功的json.
     */
    protected function success(array $data = [], ?string $message = 'success'): \Psr\Http\Message\ResponseInterface
    {
        $json = [
            'code' => ErrorCode::SUCCESS,
            'message' => is_null($message) ? ErrorCode::getMessage(ErrorCode::SUCCESS) : $message,
            'data' => null,
        ];
        // 如果是空数组一定要给null
        // 假定给到客户端的是一个对象，即花括号{}，但是因为没有找到相关数据，会导致空数组，再json_encode就会得到一个中括号[]
        // 中括号与花括号是两种数据结构，比如在go中，花括号是结构体，中括号是切片，本来约定是给花括号的，但是没数据了就给中括号，go的解析就会报错
        // 然而空数组转null后，json_encode后依然是null，强类型语言的客户端可以识别null，并忽略，不会因为类型变化报错
        if (count($data) == 0) {
            return $this->response->json($json);
        }
        // 递归里面的空数组，并转成null
        //        self::emptyArrToNull($data);
        $json['data'] = $data;
        return $this->response->json($json);
    }

    /**
     * 返回错误json.
     */
    protected function error(string $message, int $code, array $data = []): \Psr\Http\Message\ResponseInterface
    {
        $json = [
            'code' => $code,
            'message' => $message,
            'data' => null,
        ];
        if (count($data) == 0) {
            return $this->response->json($json);
        }
        // 递归里面的空数组，并转成null
        self::emptyArrToNull($data);
        $json['data'] = $data;
        return $this->response->json($json);
    }

    private static function emptyArrToNull(array &$arr): void
    {
        foreach ($arr as &$v) {
            if (is_array($v)) {
                if (count($v) == 0) {
                    $v = null;
                } else {
                    self::emptyArrToNull($v);
                }
            }
        }
    }
}
