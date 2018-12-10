<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/10
 * Time: 下午3:02
 */

// 模型基类
class Model {
    // 查找单个数据模型
    protected function one($_sql) {
        $_db = DB::getDB();
        $_result = $_db->query($_sql);
        $_object = $_result->fetch_object();
        DB::unDB($_result, $_db);

        return $_object;
    }

    // 查找多个数据模型
    protected function all($_sql) {
        $_db = DB::getDB();
        $_result = $_db->query($_sql);
        $_list = [];
        while($_object = $_result->fetch_object()) {
            $_list[] = $_object;
        }
        DB::unDB($_result, $_db);

        return $_list;

    }

    // 增删修
    protected function aud($_sql) {
        $_db = DB::getDB();
        $_db->query($_sql);
        $_affected_rows = $_db->affected_rows;
        $_result = null;
        DB::unDB($_result, $_db);

        return $_affected_rows;
    }
}