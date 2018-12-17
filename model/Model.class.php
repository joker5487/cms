<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/10
 * Time: 下午3:02
 */

// 模型基类
class Model {
    // 获取下一个增值ID模型
    public function nextId($_table) {
        $_sql = "SHOW TABLE STATUS LIKE '$_table'";
        $_object = $this->one($_sql);
        return $_object->Auto_increment;
    }

    // 获取总记录模型
    protected function total($_sql) {
        $_db = DB::getDB();
        $_result = $_db->query($_sql);
        $_total = $_result->fetch_row();
        DB::unDB($_result, $_db);

        return $_total[0];
    }
    // 查找单个数据模型
    protected function one($_sql) {
        $_db = DB::getDB();
        $_result = $_db->query($_sql);
        $_object = $_result->fetch_object();
        DB::unDB($_result, $_db);

        return Tool::htmlString($_object);
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

        return Tool::htmlString($_list);

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

    // 执行多条SQL语句的模型
    protected function mulit($_sql) {
        $_db = DB::getDB();
        $_db->multi_query($_sql);
        DB::unDB($_result, $_db);

        return true;
    }
}