<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/12
 * Time: 下午5:11
 */

require substr(dirname(__FILE__), 0, -7) . '/init.inc.php';
$_vc = new ValidateCode();
$_vc->doImg();
$_SESSION['code'] = $_vc->getCode();