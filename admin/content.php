<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/4
 * Time: 下午6:14
 */

require_once substr(dirname(__FILE__), 0, -6) . '/init.inc.php';
Validate::checkSession();
global $_tpl;

$_content = new ContentAction($_tpl); // 入口
$_content->_action();
$_tpl->display('content.tpl');