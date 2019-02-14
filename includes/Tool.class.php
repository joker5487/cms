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

    // 弹窗、赋值、关闭(仅图片上传使用)
    static public function alertOpenerClose($_info, $_path) {
        echo "<script type='text/javascript'>alert('$_info');</script>";
        echo "<script type='text/javascript'>opener.document.content.thumbnail.value='$_path';</script>";
        echo "<script type='text/javascript'>opener.document.content.pic.style.display='block';</script>";
        echo "<script type='text/javascript'>opener.document.content.pic.src='$_path';</script>";
        echo "<script type='text/javascript'>window.close();</script>";
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
        if (! $_data) {
            return '';
        }
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
        if (is_array($_data) && !GPC) {
            foreach ($_data as $_key => $_value) {
                $_data[$_key] = addslashes($_value);
            }
        } else {
            $_data = !GPC ? addslashes($_data) : $_data;
        }
        return $_data;
    }

    // 字符串截取
    static public function subStr($_object, $_filed, $_length, $_encoding) {
        if ($_object) {
            foreach ($_object as $_key => $_value) {
                if (mb_strlen($_value->$_filed, $_encoding) > $_length) {
                    $_value->$_filed = mb_substr($_value->$_filed, 0, $_length, $_encoding) . '...';
                }

                $_object[$_key] = $_value;
            }
        }

        return $_object;
    }

    // 将对象数组转换成字符串
    static public function objArrOfStr($_object, $_field) {
        $_str = '';
        if ($_object) {
            foreach ($_object as $_value) {
                $_str .= ',' . $_value->$_field;
            }
        }

        return substr($_str, 1);
    }
}