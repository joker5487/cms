<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/11/28
 * Time: 下午3:55
 */

require dirname(__FILE__) . '/init.inc.php';
global $_tpl;

// 引用模版文件
$_tpl->display('index.tpl');