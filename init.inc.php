<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/4
 * Time: 下午4:46
 */

// 开启session
session_start();

// 设置编码
header('Content-Type:text/html;charset=utf-8');

// 网站根目录
define('ROOT_PATH', dirname(__FILE__));

// 设置中国时区
date_default_timezone_set('Asia/Shanghai');

require_once ROOT_PATH . '/config/profile.inc.php';

// 自动加载类
function __autoload($_className) {
    if (substr($_className, -6) == 'Action') {
        require_once ROOT_PATH . '/action/' . $_className . '.class.php';
    } elseif (substr($_className, -5) == 'Model') {
        require_once ROOT_PATH . '/model/' . $_className . '.class.php';
    } else {
        require_once ROOT_PATH . '/includes/' . $_className . '.class.php';
    }
}

// 实例化模版类
$_tpl = new Templates();

// 引入初始化配置文件
require_once 'common.inc.php';