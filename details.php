<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/24
 * Time: 下午3:38
 */

require dirname(__FILE__) . '/init.inc.php';
global $_tpl;

$_details = new DetailsAction($_tpl);
$_details->action();
$_tpl->display('details.tpl');