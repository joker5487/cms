<?php

/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/6
 * Time: 下午5:01
 */

// 管理员实体类
class ManageModel extends Model
{
    private $id;
    private $admin_user;
    private $admin_pass;
    private $level;

    // 拦截器（__set）
    public function __set($_key, $_value)
    {
        $this->$_key = $_value;
    }

    // 拦截器（__get）
    public function __get($_key)
    {
        return $this->$_key;
    }

    // 查询所有等级
    public function getAllLevel() {
        $_sql = "
            SELECT
                id,
                level_name,
                level_info
            FROM cms_level
            ORDER BY id ASC
        ";

        return parent::all($_sql);
    }

    // 查询单个管理员
    public function getOneManage() {
        $_sql = "
            SELECT
                id,
                admin_user,
                admin_pass,
                level
            FROM cms_manage
            WHERE id = '$this->id' OR admin_user = '$this->admin_user' OR level = '$this->level'
            LIMIT 1
        ";

        return parent::one($_sql);
    }

    // 查询所有管理员
    public function getAllManage() {
        // 设置查询逻辑
        $_sql = "
          SELECT
            m.id,
            m.admin_user,
            m.login_count,
            m.last_ip,
            m.last_time,
            l.level_name
          FROM cms_manage m
          LEFT JOIN cms_level l ON m.level = l.id
          ORDER BY m.id ASC
        ";

        return parent::all($_sql);
    }

    // 新增管理员
    public function addManage() {
        $_sql = "INSERT INTO
                            cms_manage (
                                            admin_user,
                                            admin_pass,
                                            level,
                                            reg_time
                                        ) VALUES (
                                            '$this->admin_user',
                                            '$this->admin_pass',
                                            '$this->level',
                                            NOW()
                                        )";

        return parent::aud($_sql);
    }

    // 修改管理员
    public function updateManage() {
        $_sql = "
            UPDATE cms_manage
            SET
              admin_user = '$this->admin_user',
              admin_pass = '$this->admin_pass',
              level = '$this->level'
            WHERE id = '$this->id'
            LIMIT 1
        ";

        return parent::aud($_sql);
    }

    // 删除管理员
    public function deleteManage() {
        $_sql = "DELETE FROM cms_manage WHERE id = '$this->id' LIMIT 1";

        return parent::aud($_sql);
    }
}