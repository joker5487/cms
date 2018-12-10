<?php

/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/6
 * Time: 下午4:21
 */

// 数据库连接类
class DB
{

    // 获取数据库连接句柄
    static public function getDB(){
        // 连接数据库
        $_mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // 判断数据库连接是否错误
        if(mysqli_connect_errno()){
            die('数据库连接错误，错误代码：' . mysqli_connect_error());
        }
        // 设置编码集
        $_mysqli->set_charset('utf8');

        return $_mysqli;
    }

    // 销毁结果集和数据库连接句柄
    static public function unDB(&$_result, &$_db){
        if(is_object($_result)){
            // 清理结果集
            $_result->free();
            // 销毁结果集对象
            $_result = null;
        }
        if(is_object($_db)){
            // 关闭数据库
            $_db->close();
            // 销毁对象句柄
            $_db = null;
        }
    }

}