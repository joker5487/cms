<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/24
 * Time: 下午3:38
 */

require dirname(__FILE__) . '/init.inc.php';
global $_tpl;

$_list = new ListAction($_tpl);
$_list->action();
$_tpl->display('list.tpl');