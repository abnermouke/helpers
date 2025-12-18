<?php

namespace Abnermouke\Helpers\Assets;

/**
 * 文件模块方法集合
 */
class File
{


    /**
     * 获取目录下目录
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:23:36
     * @param string $directory
     * @return array
     */
    public static function dictionaries(string $directory): array
    {
        //整理目录列表
        $dictionaries = [];
        //判断是否为目录
        if (static::isDirectory($directory)) {
            //扫描目录下所有目录
            if ($scans = scandir($directory)) {
                //循环扫描结果
                foreach ($scans as $k => $dirname) {
                    //判断是否为特殊目录
                    if ($dirname !== '.' && $dirname !== '..') {
                        //整理文件路径
                        $dir_path = $directory.DIRECTORY_SEPARATOR.$dirname;
                        //判断是否为文件
                        if (static::isDirectory($dir_path)) {
                            //整理信息
                            $dictionaries[] = $dir_path;
                        }
                    }
                    //释放内存
                    unset($scans[$k]);
                }
            }
        }
        //返回文件列表
        return $dictionaries;
    }

    /**
     * 获取目录下文件
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:23:48
     * @param string $directory
     * @return array
     */
    public static function files(string $directory): array
    {
        //整理文件列表
        $files = [];
        //判断是否为目录
        if (static::isDirectory($directory)) {
            //扫描目录下所有目录
            if ($scans = scandir($directory)) {
                //循环扫描结果
                foreach ($scans as $k => $filename) {
                    //判断是否为特殊目录
                    if ($filename !== '.' && $filename !== '..') {
                        //整理文件路径
                        $file_path = $directory.DIRECTORY_SEPARATOR.$filename;
                        //判断是否为文件
                        if (static::isFile($file_path)) {
                            //整理信息
                            $files[] = static::infos($file_path);
                        }
                    }
                    //释放内存
                    unset($scans[$k]);
                }
            }
        }
        //返回文件列表
        return $files;
    }

    /**
     * 判断文件/目录是否存在
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:24:04
     * @param string $path
     * @return bool
     */
    public static function exists(string $path): bool
    {
        return file_exists($path);
    }

    /**
     * 判断文件或目录是否丢失
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:24:21
     * @param string $path
     * @return bool
     */
    public static function missing(string $path): bool
    {
        return !static::exists($path);
    }

    /**
     * 获取文件HASH
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:24:41
     * @param string $path
     * @param string $algorithm
     * @return bool|string
     */
    public static function hash(string $path, string $algorithm = 'md5'): bool|string
    {
        return hash_file($algorithm, $path);
    }

    /**
     * 写入文件内容
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:25:06
     * @param string $path
     * @param string $contents
     * @param bool $lock
     * @return bool|int
     */
    public static function put(string $path, string $contents, bool $lock = false): bool|int
    {
        return file_put_contents($path, $contents, $lock ? LOCK_EX : 0);
    }

    /**
     * 追加文件内容
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:30:49
     * @param string $path
     * @param string $content
     * @return bool|int
     */
    public static function append(string $path, string $content): bool|int
    {
        return file_put_contents($path, $content, FILE_APPEND);
    }

    /**
     * 移动文件
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-09 16:48:31
     * @param $path
     * @param $target
     * @return bool
     */
    public static function move($path, $target)
    {
        return rename($path, $target);
    }

    /**
     * 复制文件
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:32:15
     * @param string $path
     * @param string $target
     * @return bool
     */
    public static function copy(string $path, string $target): bool
    {
        return copy($path, $target);
    }

    /**
     * 获取文件名称
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:33:04
     * @param string $path
     * @return string|array
     */
    public static function name(string $path): string|array
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    /**
     * 获取文件基础路径名称
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:36:44
     * @param string $path
     * @return array|string
     */
    public static function basename(string $path): array|string
    {
        return pathinfo($path, PATHINFO_BASENAME);
    }

    /**
     * 获取文件目录名称
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:37:19
     * @param string $path
     * @return array|string
     */
    public static function dirname(string $path): array|string
    {
        return pathinfo($path, PATHINFO_DIRNAME);
    }

    /**
     * 获取文件后缀
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:37:43
     * @param string $path
     * @return array|bool
     */
    public static function extension(string $path): array|bool
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }

    /**
     * 获取文件类型
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:38:00
     * @param string $path
     * @return bool|string
     */
    public static function type(string $path): bool|string
    {
        return filetype($path);
    }

    /**
     * 获取文件mine-type
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:38:17
     * @param string $path
     * @return bool|string
     */
    public static function mimeType(string $path): bool|string
    {
        return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $path);
    }

    /**
     * 获取文件大小
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:38:32
     * @param string $path
     * @return bool|int
     */
    public static function size(string $path): bool|int
    {
        return filesize($path);
    }

    /**
     * 获取文件最后修改时间
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:38:49
     * @param string $path
     * @return bool|int
     */
    public static function lastModified(string $path): bool|int
    {
        return filemtime($path);
    }

    /**
     * 判断是否是个目录
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:39:02
     * @param string $directory
     * @return bool
     */
    public static function isDirectory(string $directory): bool
    {
        return is_dir($directory);
    }

    /**
     * 判断是否是个文件
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:39:20
     * @param string $file
     * @return bool
     */
    public static function isFile(string $file): bool
    {
        return is_file($file);
    }

    /**
     * 创建目录
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:39:41
     * @param string $path
     * @param int $mode
     * @param bool $recursive
     * @param bool $force
     * @return bool
     */
    public static function makeDirectory(string $path, int $mode = 0755, bool $recursive = false, bool $force = false): bool
    {
        if ($force) {
            return @mkdir($path, $mode, $recursive);
        }

        return mkdir($path, $mode, $recursive);
    }

    /**
     * 检查目录情况
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:39:59
     * @param string $path
     * @return string
     */
    public static function checkDictionary(string $path): string
    {
        //获取目录
        $dictionary = static::dirname($path);
        //判断是否为目录
        if (static::missing($dictionary) || !static::isDirectory($dictionary)) {
            //创建目录
            static::makeDirectory($dictionary, 0755, true);
        }
        //返回信息
        return $path;
    }

    /**
     * 删除指定文件
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:40:18
     * @param mixed $paths
     * @return bool
     */
    public static function delete(mixed $paths): bool
    {
        $paths = is_array($paths) ? $paths : func_get_args();

        $success = true;

        foreach ($paths as $path) {
            try {
                if (@unlink($path)) {
                    clearstatcache(false, $path);
                } else {
                    $success = false;
                }
            } catch (\ErrorException $e) {
                $success = false;
            }
        }

        return $success;
    }

    /**
     * 获取文件内容信息
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-18 13:40:49
     * @param string $path
     * @return array
     */
    public static function infos(string $path): array
    {
        //整理文件信息
        return [
            'path' => $path,
            'name' => static::name($path),
            'basename' => static::basename($path),
            'dirname' => static::dirname($path),
            'extension' => static::extension($path),
            'type' => static::type($path),
            'mime_type' => static::mimeType($path),
            'size' => static::size($path),
            'time' => static::lastModified($path),
        ];
    }

}
