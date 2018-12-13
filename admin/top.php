<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/4
 * Time: 下午5:46
 */

require substr(dirname(__FILE__), 0, -6) . '/init.inc.php';
global $_tpl;

Validate::checkSession();

$_tpl->assign('admin_user', $_SESSION['admin']['admin_user']);
$_tpl->assign('level_name', $_SESSION['admin']['level_name']);
$_tpl->display('top.tpl');