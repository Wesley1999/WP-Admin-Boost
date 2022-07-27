<?php

// 原作者: 潘羿
// URI: https://www.idleleo.com/
// Github: https://github.com/paniy/WP-Admin-Boost

// 以下为插件描述

/**
 * Plugin Name: WP Admin Boost
 * Description: 使用阿里云oss加速WordPress的后台核心小文件，大幅提高后台访问速度。
 * Author: Wesley
 * Author URI: https://www.bunny.icu/
 * Version: 2.0.0
 * Network: True
 * License: GPLv3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

(new WP_ADMIN_BOOST)->init();

class WP_ADMIN_BOOST
{
    public function init()
    {
        if (is_admin() && !(defined('DOING_AJAX') && DOING_AJAX)) {
            if (!stristr($GLOBALS['wp_version'], 'alpha') && !stristr($GLOBALS['wp_version'], 'beta')) {
                add_action('init', function () {
                    ob_start(function ($buffer) {
                        $buffer = preg_replace('~' . home_url('/') . '(wp-admin|wp-includes)/(css|js)/~', sprintf('//cdn-wsg.oss-cn-shanghai.aliyuncs.com/wordpress-6.0.1/$1/$2/'), $buffer);
                        // $buffer = preg_replace('~' . home_url('/') . '(wp-admin|wp-includes)/(css|js)/~', sprintf('//cdn.jsdelivr.net/gh/WordPress/WordPress@%s/$1/$2/', $GLOBALS['wp_version']), $buffer);
                        return $buffer;
                    });
                });
            };

        }
    }
}
