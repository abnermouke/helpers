<?php

namespace Abnermouke\Helpers\Assets;

use Abnermouke\Helpers\Library\BasicLibrary;

/**
 * 仓库包方法集合
 */
class Packagist
{
    /**
     * 查询指定包名
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-09 17:01:55
     * @param $package_name
     * @return bool
     */
    public static function find($package_name)
    {
        //获取composer内容
        $contents = self::getComposerJson();
        //判断是否存在内容
        if (data_get($contents, 'name', '') == $package_name) {
            //返回成功
            return true;
        }
        //判断目录
        $vendor_dictionaries = File::dictionaries(Path::vendor());
        //判断是否存在tp
        if ($vendor_dictionaries && in_array(Path::vendor(explode('/', $package_name)[0]), $vendor_dictionaries)) {
            //返回成功
            return true;
        }
        //返回失败
        return false;
    }

    /**
     * 获取根目录composer.json内容
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-10-09 16:59:41
     * @return array|mixed
     */
    public static function getComposerJson()
    {
        //获取根目录下composer.json
        $json_path = Path::root().'composer.json';
        //判断是否为文件
        if (File::exists($json_path) && File::isFile($json_path)) {
            //返回信息
            return BasicLibrary::objectToArray(file_get_contents($json_path));
        }
        //返回为空
        return [];
    }

}
