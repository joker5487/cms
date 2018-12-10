<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/4
 * Time: 下午4:46
 */

// 设置编码
header('Content-Type:text/html;charset=utf-8');

// 网站根目录
define('ROOT_PATH', dirname(__FILE__));

require_once ROOT_PATH . '/config/profile.inc.php';

// 引入模版类文件
require_once ROOT_PATH . '/includes/init.class.php';

// 引入数据库连接类文件
require_once ROOT_PATH . '/includes/DB.class.php';

// 引入工具类文件
require_once ROOT_PATH . '/includes/Tool.class.php';

// 引入缓存配置文件
require_once 'cache.inc.php';

// 实例化模版类
$_tpl = new Templates();