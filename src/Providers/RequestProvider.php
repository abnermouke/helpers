<?php

namespace Abnermouke\Helpers\Providers;

use Abnermouke\Helpers\Libraries\CodeLibrary;
use Abnermouke\Helpers\Libraries\FakeUserAgentLibrary;
use GuzzleHttp\Client;

/**
 * 请求服务提供类
 */
class RequestProvider
{


    //超时时间
    private int $timeout = 30;
    //请求链接
    private string $url;
    //请求方式
    private string $method;
    //请求头
    private array $headers = [];
    //请求参数
    private array $params;
    //请求配置
    private array $options;
    //请求解惑
    private mixed $results;

    /**
     * 构造函数
     * @param string $url
     * @param array $params
     * @throws \Exception
     */
    public function __construct(string $url, array $params)
    {
        //设置基础参数
        $this->url = $url;
        //设置默认参数
        $this->timeout(30)->headers([
            'verify' => false,
            'User-Agent' => FakeUserAgentLibrary::random()
        ])->params($params)->method('post');
    }

    /**
     * 发起请求
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:31:13
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function request(): object
    {
        //创建请求实例
        $client = new Client(['timeout' => $this->timeout]);
        //尝试发起请求
        try {
            //发起请求
            $response = $client->request($this->method, $this->url, $this->options);
            //判断请求状态码
            if ($response->getStatusCode() !== 200) {
                //抛出异常
                throw new \Exception('请求失败，状态码：'.$response->getStatusCode());
            }
            //获取结果内容
            $this->results = $response->getBody()->getContents();
        } catch (\Exception $exception) {
            //响应失败
            return ResponseProvider::make($exception->getCode(), [], $exception->getMessage(), ['method' => $this->method, 'url' => $this->url, 'options' => $this->options, 'error' => $exception->getMessage()]);
        }
        //返回当前实例
        return ResponseProvider::make(CodeLibrary::CODE_SUCCESS, $this->results, '请求成功', ['method' => $this->method, 'url' => $this->url, 'options' => $this->options]);
    }

    /**
     * 表单提交（application/x-www-form-urlencoded）
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:44:49
     * @return RequestProvider
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function form(): static
    {
        //初始化请求参数
        $this->options = [
            'headers' => $this->headers,
            'form_prams' => $this->params
        ];
        //发起请求
        return $this->request();
    }

    /**
     * JSON提交（application/json）
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:44:49
     * @return RequestProvider
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function json(): static
    {
        //初始化请求参数
        $this->options = [
            'headers' => $this->headers,
            'json' => $this->params
        ];
        //发起请求
        return $this->request();
    }

    /**
     * BODY提交
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:44:49
     * @return RequestProvider
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function body(): static
    {
        //初始化请求参数
        $this->options = [
            'headers' => $this->headers,
            'body' => $this->params
        ];
        //发起请求
        return $this->request();
    }

    /**
     * 设置头信息
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:36:40
     * @param array $headers
     * @return $this
     */
    public function headers(array $headers = []): static
    {
        //判断头信息
        if ($headers) {
            //设置头信息
            $this->headers = $this->headers ? array_merge($this->headers, $headers) : $headers;
        }
        //返回当前实例
        return $this;
    }

    /**
     * 设置超时
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:36:34
     * @param int $timeout
     * @return $this
     */
    public function timeout(int $timeout = 30): static
    {
        //设置超时
        $this->timeout = $timeout;
        //返回当前实例
        return $this;
    }

    /**
     * 设置当前请求方式
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:36:27
     * @param string $method
     * @return $this
     */
    public function method(string $method = 'post'): static
    {
        //设置当前请求方式
        $this->method = $method;
        //返回当前实例
        return $this;
    }

    /**
     * 设置请求参数
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:36:19
     * @param array $params
     * @return $this
     */
    public function params(array $params = []): static
    {
        //设置请求参数
        $this->params = $params;
        //返回当前实例
        return $this;
    }

    /**
     * 创建实例
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 14:36:08
     * @param string $url
     * @param array $params
     * @return RequestProvider
     * @throws \Exception
     */
    public static function make(string $url, array $params = []): RequestProvider
    {
        //创建实例
        return new RequestProvider($url, $params);
    }


}
