<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/12
 * Time: 下午4:53
 */

require substr(dirname(__FILE__), 0, -6) . '/init.inc.php';
global $_tpl;

if (isset($_SESSION['admin'])) Tool::alertLocation(null, 'admin.php');
$_tpl->display('admin_login.tpl');