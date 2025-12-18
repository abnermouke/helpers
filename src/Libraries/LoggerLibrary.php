<?php

namespace Abnermouke\Helpers\Libraries;

use Abnermouke\Helpers\Assets\File;
use Abnermouke\Helpers\Assets\Path;

/**
 * 日志记录藏类
 */
class LoggerLibrary
{


    //日志记录目录
    private static string $loggerPath;

    /**
     * 创建日志目录
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 14:04:29
     */
    private static function create(): void
    {
        //初始化目录
        static::$loggerPath = Path::logger();
    }

    /**
     * 记录日志
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 14:04:59
     * @param string $alias 识别标识
     * @param mixed $content 记录内容 json|array|string|mixed
     * @param string $logger_path 自定义目录
     * @return bool
     */
    public static function record(string $alias, mixed $content, string $logger_path = ''): bool
    {
        //初始化目录
        static::create();
        //初始化路径
        $path = static::$loggerPath.DIRECTORY_SEPARATOR.($logger_path ? Path::format($logger_path) : (str_replace([' ', ':'], DIRECTORY_SEPARATOR, strtolower($alias)).DIRECTORY_SEPARATOR.date('Y-m-d').'.log'));
        //获取文件目录
        if (File::missing($path)) {
            //判断目录
            if (!File::isDirectory(($directory = File::dirname($path)))) {
                //创建目录
                File::makeDirectory($directory, 0755, true);
            }
            //写入文件
            File::put($path, self::contents('SYSTEM', '创建日志记录文件'));
        }
        //追加文件内容
        File::append($path, self::contents($alias, $content));
        //返回成功
        return true;
    }

    /**
     * 设置文件内容
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 14:05:42
     * @param string $alias
     * @param mixed $content
     * @return string
     * @throws \Exception
     */
    private static function contents(string $alias, mixed $content): string
    {
        //整理基础结构
        $contents = [];
        //生成唯一编码
        $sn = BasicLibrary::createSn();
        //追加内容
        $contents[] = "============================ BEGIN ".$sn." =========================";
        //设置内容
        $contents[] = BasicLibrary::formatDateTime()." [".strtoupper($alias)."]  ".(is_array($content) ? json_encode($content, JSON_UNESCAPED_UNICODE) : $content);
        //设置结束
        $contents[] = "============================ END ".$sn." ===========================";
        //追加换行符
        $contents[] = "\n";
        //返回信息
        return implode("\n\n", $contents);
    }


}
