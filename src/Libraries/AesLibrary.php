<?php

namespace Abnermouke\Helpers\Libraries;

/**
 * AES加解密藏类
 */
class AesLibrary
{


    /**
     * 加密AES内容
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time2025-10-10 14:28:25
     * @param $data array 加密内容
     * @param $aes_encrypt_key string 加密KEY（16位）
     * @param $iv string 加密IV（16位）
     * @param $cipher_algo string 加密方法
     * @param $options int 加密格式选项
     * @return false|string
     */
    public static function encrypt($data, $aes_encrypt_key, $iv, $cipher_algo = 'AES-128-CBC', $options = OPENSSL_RAW_DATA)
    {
        //整理解密内容
        $encrypt_data = json_encode($data);
        //加密信息
        $encrypt_string = openssl_encrypt($encrypt_data, $cipher_algo, $aes_encrypt_key, $options, $iv);
        //返回加密字符串
        return base64_encode($encrypt_string);
    }

    /**
     * 解密AES内容
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time2025-10-10 14:22:30
     * @param $encrypt_string string 加密字符串
     * @param $aes_encrypt_key string 加密KEY（16位）
     * @param $iv string 加密IV（16位）
     * @param $cipher_algo string 加密方法
     * @param $options int 加密格式选项
     * @param $base64_encoding int 是否已加密（BASE64）
     * @return mixed
     */
    public static function decrypt($encrypt_string, $aes_encrypt_key, $iv, $cipher_algo = 'AES-128-CBC', $options = OPENSSL_RAW_DATA, $base64_encoding = true)
    {
        //初始化信息
        $encrypt_string = $base64_encoding ? base64_decode($encrypt_string) : $encrypt_string;
        //解密信息
        $encrypt_data = openssl_decrypt($encrypt_string, $cipher_algo, $aes_encrypt_key,  $options, $iv);
        //整理信息
        $json_str = rtrim($encrypt_data, "\0");
        //获取表单数据
        return json_decode($json_str, true);
    }


}
