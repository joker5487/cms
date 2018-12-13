<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/7
 * Time: 下午1:33
 */
class Tool {

    // 弹窗跳转
    static public function alertLocation($_info, $_url) {
        if (!empty($_info)) {
            echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
            exit();
        } else {
            header('Location: ' . $_url);
            exit();
        }

    }

    // 弹窗返回
    static public function alertBack($_info) {
        echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
        exit();
    }

    // 清理session
    static public function unSession() {
        if (session_start()) {
            session_destroy();
        }
    }

    // 显示 html 过滤
    static public function htmlString($_data) {
        if (is_array($_data)) {
            foreach ($_data as $_key => $_value) {
                $_string[$_key] = Tool::htmlString($_value);
            }
        } elseif (is_object($_data)) {
            $_string = new stdClass();
            foreach ($_data as $_key => $_value) {
                $_string->$_key = Tool::htmlString($_value);
            }
        } else {
            $_string = htmlspecialchars($_data);
        }
        return $_string;
    }

    // 数据库输入过滤
    static public function mysqlString($_data) {
        return !GPC ? addslashes($_data) : $_data;
    }
}