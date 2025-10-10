<?php

namespace Abnermouke\Helpers\Providers;


use Abnermouke\Helpers\Libraries\CodeLibrary;

/**
 * 响应服务提供者
 */
class ResponseProvider
{

    /**
     * 响应结果
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:28:07
     * @param int $code 状态码
     * @param mixed $data 返回数据
     * @param string $message 提示信息
     * @param array $extras 额外信息
     * @return object
     */
    public function response(int $code, mixed $data = [], string $message = '', array $extras = []): object
    {
        //设置状态
        $state = $code === CodeLibrary::CODE_SUCCESS;
        //整理信息
        $result = compact('state', 'code', 'data', 'message', 'extras');
        //返回对象信息
        return (object)$result;
    }

    /**
     * 创建通用响应结果
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:27:31
     * @param int $code 状态码
     * @param mixed $data 返回数据
     * @param string $message 提示信息
     * @param array $extras 额外信息
     * @return object
     */
    public static function make(int $code, mixed $data = [], string $message = '', array $extras = []): object
    {
        //返回响应结果
        return (new ResponseProvider())->response($code, $data, $message, $extras);
    }


}
