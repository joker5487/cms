<?php

/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/6
 * Time: 下午5:01
 */

// 等级实体类
class LevelModel extends Model
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

    // 获取管理员总记录
    public function getLevelTotal() {
        $_sql = "
            SELECT count(id)
            FROM cms_level
        ";

        return parent::total($_sql);
    }

    // 查询单个
    public function getOneLevel() {
        $_sql = "
            SELECT
                id,
                level_name,
                level_info
            FROM cms_level
            WHERE id = '$this->id' OR level_name = '$this->level_name'
            LIMIT 1
        ";

        return parent::one($_sql);
    }

    // 查询所有
    public function getAllLevel() {
        // 设置查询逻辑
        $_sql = "
          SELECT
                id,
                level_name,
                level_info
            FROM cms_level
            ORDER BY id ASC
            $this->limit
        ";

        return parent::all($_sql);
    }

    // 新增等级
    public function addLevel() {
        $_sql = "INSERT INTO
                            cms_level (
                                            level_name,
                                            level_info
                                        ) VALUES (
                                            '$this->level_name',
                                            '$this->level_info'
                                        )";

        return parent::aud($_sql);
    }

    // 修改等级
    public function updateLevel() {
        $_sql = "
            UPDATE cms_level
            SET
              level_name = '$this->level_name',
              level_info = '$this->level_info'
            WHERE id = '$this->id'
            LIMIT 1
        ";

        return parent::aud($_sql);
    }

    // 删除等级
    public function deleteLevel() {
        $_sql = "DELETE FROM cms_level WHERE id = '$this->id' LIMIT 1";

        return parent::aud($_sql);
    }
}