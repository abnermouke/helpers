<?php

namespace Abnermouke\Helpers\Libraries;

use Abnermouke\Helpers\Assets\Arr;
use Abnermouke\Helpers\Assets\Str;

/**
 * 签名加解密藏类
 */
class SignatureLibrary
{


    //密钥KEY
    private string $key;
    //密钥SECRET
    private string $secret;

    /**
     * 创建验签实例
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:51:26
     * @param $key string 密钥KEY
     * @param $secret string 密钥Secret
     * @return SignatureLibrary
     */
    public static function make(string $key, string $secret): static
    {
        //创建实例
        return (new SignatureLibrary($key, $secret));
    }

    /**
     * 构造函数
     * @param $key string 密钥KEY
     * @param $secret string 密钥Secret
     */
    public function __construct(string $key, string $secret)
    {
        //设置密钥信息
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * 创建签名参数
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:58:16
     * @param $body array 原请求参数
     * @return array
     * @throws \Exception
     */
    public function create(array $body): array
    {
        //整理常规参数
        $__timestamp__ = time();
        $__nonceStr__ = Str::random(8);
        //生成签名
        $__signature__ = $this->signature($this->getSignatureString($body), $__timestamp__, $__nonceStr__);
        //返回结果集
        return array_merge($body, compact('__timestamp__', '__nonceStr__', '__signature__'));
    }

    /**
     * 生成签名
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2023-04-18 23:01:03
     * @param $params string 签名参数（键值对，&隔开）
     * @param $timestamp int 时间戳
     * @param $nonceStr string 随机字符串
     * @return string
     */
    private function signature(string $params, int $timestamp, string $nonceStr): string
    {
        //生成签名
        return  md5($this->key.$timestamp.$params.$nonceStr.$this->secret);
    }

    /**
     * 验证参数
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2023-04-18 23:06:37
     * @param $body array 传输参数
     * @param $expire_second int 签名有效秒数
     * @return mixed
     */
    public function verify(array $body, int $expire_second = 60): mixed
    {
        //移除系统参数
        $content = Arr::except($body, ['__timestamp__', '__nonceStr__', '__signature__']);
        //获取body签名
        $body_signature = $this->signature($this->getSignatureString($content), data_get($body, '__timestamp__', 0), data_get($body, '__nonceStr__', ''));
        //判断签名
        if (trim($body_signature) !== trim(data_get($body, '__signature__', ''))) {
            //返回失败
            return false;
        }
        //判断是否过期
        if ((int)$body['__timestamp__'] + $expire_second <= time()) {
            //返回失败
            return false;
        }
        //返回内容
        return $content;
    }

    /**
     * 获取签名字符串（键值对参数）
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2023-04-18 23:03:40
     * @param $body array 传输参数
     * @return string
     */
    public function getSignatureString(array $body): string
    {
        //整理参数
        $params = [];
        //循环数组
        foreach ($body as $k => $v) {
            //排除null与空字符串
            if (!empty($v)) {
                //判断是否为数组
                $v = is_array($v) ? json_encode($v) : $v;
                //urlencode数据并以键值对形式展示
                $params[] = $k.'='.rawurlencode($v);
            }
        }
        //倒序排列
        krsort($params);
        //返回键值对
        return implode('&', $params);
    }


}
