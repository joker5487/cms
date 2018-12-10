<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/4
 * Time: 下午6:14
 */

require_once substr(dirname(__FILE__), 0, -6) . '/init.inc.php';
require_once ROOT_PATH . '/model/Manage.class.php';
global $_tpl;

new Manage($_tpl); // 入口
