<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/11
 * Time: 下午1:24
 */
class Validate {

    // 是否为空
    static public function checkNull($_data) {
        if (trim($_data) == '') {
            return true;
        }
        return false;
    }

    // 判断是否为数字
    static public function checkNum($_data) {
        if ( ! is_numeric($_data)) return true;
        return false;
    }

    // 长度是否合法
    static public function checkLength($_data, $_length, $_flag) {
        if ($_flag == 'min') {
            if (mb_strlen(trim($_data), 'utf-8') < $_length) {
                return true;
            }
            return false;
        } elseif ($_flag == 'max') {
            if (mb_strlen(trim($_data), 'utf-8') > $_length) {
                return true;
            }
            return false;
        } elseif ($_flag == 'equals') {
            if (mb_strlen(trim($_data), 'utf-8') != $_length) {
                return true;
            }
            return false;
        } else {
            Tool::alertBack('ERROR：参数传递错误，必须是 min 或 max');
        }

    }

    // 数据是否一致
    static public function checkEquals($_data, $_otherdata) {
        if (trim($_data) != trim($_otherdata)) {
            return true;
        }
        return false;
    }

    // 检查session是否存在
    static public function checkSession() {
        if (!isset($_SESSION['admin'])) Tool::alertBack('警告：非法登录！');
    }
}