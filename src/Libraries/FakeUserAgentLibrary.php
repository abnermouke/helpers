<?php

namespace Abnermouke\Helpers\Libraries;

use Abnermouke\Helpers\Assets\Arr;

/**
 * 假UA藏类
 */
class FakeUserAgentLibrary
{

    /**
     * 获取随机UA
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 14:02:40
     * @return mixed
     * @throws \Exception
     */
    public static function random(): mixed
    {
        //获取UA信息
        $userAgents = self::getFakeUserAgent();
        //随机获取设备
        $browser = Arr::random(array_values(data_get($userAgents, 'randomize', [])));
        //获取指定浏览器UA
        return self::browser($browser);
    }

    /**
     * 指定Chrome访问UA
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 14:03:52
     * @return mixed
     */
    public static function chrome(): mixed
    {
        //指定 Chrome UA
        return self::browser('chrome', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
    }

    /**
     * 指定Opera访问UA
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 14:03:43
     * @return mixed
     */
    public static function opera(): mixed
    {
        //指定 Opera UA
        return self::browser('opera', 'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16');
    }

    /**
     * 指定Firefox访问UA
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 14:03:37
     * @return mixed
     */
    public static function firefox(): mixed
    {
        //指定 Firefox UA
        return self::browser('firefox', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1');
    }

    /**
     * 指定Internetexplorer访问UA
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 14:03:30
     * @return mixed
     */
    public static function internetexplorer(): mixed
    {
        //指定 Internetexplorer UA
        return self::browser('internetexplorer', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko');
    }

    /**
     * 指定Safari访问UA
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 14:03:16
     * @return mixed
     */
    public static function safari(): mixed
    {
        //指定 Safari UA
        return self::browser('safari', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A');
    }

    /**
     * 获取指定浏览器UA
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 14:03:10
     * @param $browser
     * @param $default
     * @return mixed
     */
    protected static function browser($browser = 'chrome', $default = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36'): mixed
    {
        //获取UA信息
        $userAgents = self::getFakeUserAgent();
        //获取全部UA
        $userAgents = data_get($userAgents, 'browsers.'.$browser, []);
        //判断是否存在UA
        if ($userAgents) {
            //获取一条并设为默认
            $default = Arr::random($userAgents);
        }
        //返回默认UA
        return $default;
    }

    /**
     * 获取伪造UA信息
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-10 12:24:18
     * @return mixed
     */
    private static function getFakeUserAgent(): mixed
    {
        //获取json信息
        $ua = file_get_contents(__DIR__.'/../../data/fake_useragent.json');
        //初始化信息
        return json_decode($ua, true);
    }

}
