<?php

/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/6
 * Time: 下午5:01
 */

// 内容实体类
class ContentModel extends Model
{
    private $id;
    private $level_name;
    private $level_info;
    private $limit;

    // 拦截器（__set）
    public function __set($_key, $_value)
    {
        $this->$_key = Tool::mysqlString($_value);
    }

    // 拦截器（__get）
    public function __get($_key)
    {
        return $this->$_key;
    }
}