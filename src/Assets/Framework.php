<?php

namespace Abnermouke\Helpers\Assets;

use Abnermouke\Supports\Assists\File;
use Abnermouke\Supports\Assists\Path;

/**
 * 框架模块方法集合
 */
class Framework
{

    /**
     * 判断是否存在thinkphp
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-09 17:03:20
     * @return bool
     */
    public static function thinkphp()
    {
        //判断是否存在thinkphp
        return Packagist::find('topthink/think');
    }

    /**
     * 判断是否存在laravel
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-09 17:03:28
     * @return bool
     */
    public static function laravel()
    {
        //判断是否存在laravel
        return Packagist::find('laravel/laravel');
    }

    /**
     * 判断是否存在hyperf
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-09 17:03:34
     * @return bool
     */
    public static function hyperf()
    {
        //判断是否存在hyperf
        return Packagist::find('hyperf/framework');
    }


}
