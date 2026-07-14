<?php

namespace Abnermouke\Helpers\Assets;

/**
 * 路径模块方法集合
 */
class Path
{

    /**
     * 获取项目路径
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:43:58
     * @param string $dictionary
     * @return string
     */
    public static function root(string $dictionary = ''): string
    {
        //替换信息
        $root_path = str_replace(('vendor'.DIRECTORY_SEPARATOR.'abnermouke'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Assets'), '', __DIR__);
        //返回目录
        return $root_path.$dictionary;
    }

    /**
     * 获取APP路径
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:44:13
     * @param string $path
     * @return string
     */
    public static function app(string $path = ''): string
    {
        //返回地址
        return static::target('app', $path);
    }

    /**
     * 获取public路径
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:44:37
     * @param string $path
     * @return string
     */
    public static function public(string $path = ''): string
    {
        //返回地址
        return static::target('public', $path);
    }


    /**
     * 获取vendor路径
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:44:57
     * @param string $path
     * @return string
     */
    public static function vendor(string $path = ''): string
    {
        //返回地址
        return static::target('vendor', $path);
    }

    /**
     * 获取日志记录目录
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:45:13
     * @param bool $mkdir
     * @param int $mode
     * @return string
     */
    public static function logger(bool $mkdir = true, int $mode = 0755): string
    {
        //判断框架
        if (Framework::laravel()) {
            //整理路径
            $path = self::target('storage', 'logs/logger');
        } elseif (Framework::thinkphp()) {
            //整理路径
            $path = self::target('runtime', 'logger');
        } elseif (Framework::hyperf()) {
            //整理路径
            $path = self::target('runtime', 'logger');
        } else {
            //整理路径
            $path = self::target('logger');
        }
        //判断是否创建目录
        if ($mkdir && !File::isDirectory($path)) {
            //创建目录
            File::makeDirectory($path, $mode, true);
        }
        //返回路径
        return $path;
    }

    /**
     * 格式化路径
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:45:31
     * @param string $path
     * @return array|string
     */
    public static function format(string $path): array|string
    {
        //整理信息
        return $path ? str_replace(['/', '\''], DIRECTORY_SEPARATOR, $path) : '';
    }

    /**
     * 获取指定目录
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:45:50
     * @param string $root_dictionary
     * @param string $path
     * @return string
     */
    public static function target(string $root_dictionary, string $path = ''): string
    {
        //获取根目录
        $root_path = static::root($root_dictionary);
        //判断是否追加路径
        if ($path && (($path = static::format($path)) !== DIRECTORY_SEPARATOR)) {
            //追加地址
            $root_path .= DIRECTORY_SEPARATOR.$path;
        }
        //返回地址
        return $root_path;
    }


}
