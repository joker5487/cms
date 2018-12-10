<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/11/28
 * Time: 下午3:55
 */

require dirname(__FILE__) . '/init.inc.php';

// 声明变量
$_name = 'joker.chen';
$_condition = 0;
$_array = [1, 2, 3, 4, 5];

// 注入变量
$_tpl->assign('name', $_name);
$_tpl->assign('condition', $_condition);
$_tpl->assign('array', $_array);


// 引用模版文件
$_tpl->display('index.tpl');