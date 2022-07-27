<?php

/**
 * Plugin Name: WP Admin Boost
 * Description: 使用jsdelivr加速WordPress的后台核心小文件与插件小文件，大幅提高后台访问速度。
 * Author: 潘羿
 * Author URI:https://www.idleleo.com/
 * Version: 1.0.3
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
                        $buffer = preg_replace('~' . home_url('/') . '(wp-admin|wp-includes)/(css|js)/~', sprintf('//cdn.jsdelivr.net/gh/WordPress/WordPress@%s/$1/$2/', $GLOBALS['wp_version']), $buffer);
                        return $buffer;
                    });
                });
            };

        }
    }
}
