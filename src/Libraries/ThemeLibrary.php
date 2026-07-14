<?php

namespace Abnermouke\Helpers\Libraries;

use Abnermouke\Helpers\Assets\Arr;

/**
 * 主题藏库
 */
class ThemeLibrary
{

    public const THEME_PRIMARY = 'primary';
    public const THEME_SUCCESS = 'success';
    public const THEME_INFO = 'info';
    public const THEME_WARNING = 'warning';
    public const THEME_DANGER = 'danger';
    public const THEME_DARK = 'dark';
    public const THEME_LIGHT = 'light';
    public const THEME_SECONDARY = 'secondary';
    public const THEME_TRANSPARENT = 'transparent';
    public const THEME_DEFAULT = 'default';
    public const THEME_GRAY = 'gray';
    public const THEME_BLUE = 'blue';
    public const THEME_GREEN = 'green';
    public const THEME_RED = 'red';
    public const THEME_YELLOW = 'yellow';
    public const THEME_PURPLE = 'purple';
    public const THEME_ORANGE = 'orange';
    public const THEME_PINK = 'pink';

    /**
     * 状态主题
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-19 15:07:40
     * @return string[]
     */
    public static function states(): array
    {
        //返回状态对应主题色
        return [1 => self::THEME_SUCCESS, 2 => self::THEME_WARNING, 3 => self::THEME_PRIMARY, 4 => self::THEME_WARNING, 5 => self::THEME_DANGER];
    }

    /**
     * 开关主题
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-19 15:08:21
     * @return string[]
     */
    public static function switches(): array
    {
        //返回开关对应主题色
        return [1 => self::THEME_SUCCESS, 2 => self::THEME_DANGER];
    }

    /**
     * 随机主题
     * @Author Abnermouke <abnermouke@outlook.com | yunnitec@outlook.com>
     * @Company Chongqing Yunni Network Technology Co., Ltd.
     * @Time 2025-12-19 15:09:40
     * @param int $num
     * @return array
     */
    public static function random(int $num = 3): array
    {
        //随机数量主题
        return Arr::random([
            self::THEME_PRIMARY, self::THEME_SUCCESS, self::THEME_INFO, self::THEME_WARNING, self::THEME_DANGER, self::THEME_DARK, self::THEME_LIGHT, self::THEME_SECONDARY, self::THEME_TRANSPARENT, self::THEME_DEFAULT,
            self::THEME_GRAY, self::THEME_BLUE, self::THEME_GREEN, self::THEME_RED, self::THEME_YELLOW, self::THEME_PURPLE, self::THEME_ORANGE, self::THEME_PINK
        ], $num);
    }

}
