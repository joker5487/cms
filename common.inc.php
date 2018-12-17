<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/4
 * Time: 下午5:26
 */

// 开启缓冲区, 前台专用
define('IS_CACHE', FALSE);

// 开启缓冲区
IS_CACHE ? ob_start() : NULL;

// 模版句柄
global $_tpl;
$_nav = new NavAction($_tpl);
$_nav->showfront(); // 列出主导航