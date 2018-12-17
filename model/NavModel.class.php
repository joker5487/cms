<?php

/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/6
 * Time: 下午5:01
 */

// 导航实体类
class NavModel extends Model
{
    private $id;
    private $nav_name;
    private $nav_info;
    private $pid;
    private $sort;
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

    // 获取主导航总记录
    public function getNavTotal() {
        $_sql = "
            SELECT count(id)
            FROM cms_nav
            WHERE pid = 0
        ";

        return parent::total($_sql);
    }

    // 获取子导航总记录
    public function getNavChildTotal() {
        $_sql = "
            SELECT count(id)
            FROM cms_nav
            WHERE pid = '$this->id'
        ";

        return parent::total($_sql);
    }

    // 查询所有主导航
    public function getAllNav() {
        // 设置查询逻辑
        $_sql = "
          SELECT
                id,
                nav_name,
                nav_info,
                pid,
                sort
            FROM cms_nav
            WHERE pid = 0
            ORDER BY sort ASC
          $this->limit
        ";

        return parent::all($_sql);
    }

    // 查询所有子导航
    public function getAllChildNav() {
        $_sql = "
          SELECT
                id,
                nav_name,
                nav_info,
                pid,
                sort
            FROM cms_nav
            WHERE pid = '$this->id'
            ORDER BY sort ASC
          $this->limit
        ";

        return parent::all($_sql);
    }

    // 新增
    public function addNav() {
        $_sql = "INSERT INTO
                            cms_nav (
                                nav_name,
                                nav_info,
                                pid,
                                sort
                            ) VALUES (
                                '$this->nav_name',
                                '$this->nav_info',
                                '$this->pid',
                                " . parent::nextId('cms_nav') . "
                            )";

        return parent::aud($_sql);
    }

    // 查询单个
    public function getOneNav() {
        $_sql = "
            SELECT
                id,
                nav_name,
                nav_info,
                pid,
                sort
            FROM cms_nav
            WHERE id = '$this->id' OR nav_name = '$this->nav_name'
            LIMIT 1
        ";

        return parent::one($_sql);
    }

    // 删除导航
    public function deleteNav() {
        $_sql = "DELETE FROM cms_nav WHERE id = '$this->id' LIMIT 1";

        return parent::aud($_sql);
    }

    // 修改等级
    public function updateNav() {
        $_sql = "
            UPDATE cms_nav
            SET
              nav_name = '$this->nav_name',
              nav_info = '$this->nav_info'
            WHERE id = '$this->id'
            LIMIT 1
        ";

        return parent::aud($_sql);
    }

    // 导航排序
    public function setNavSort() {
        $_sql = '';
        foreach ($this->sort as $key => $value) {
            $_sql .= "UPDATE cms_nav SET sort = '$value' WHERE id = '$key';";
        }

        return parent::mulit($_sql);
    }


    /* ================================================== 分割线：前台页面使用 ================================================== */
    public function getFrontNav() {
        $_sql = "
            SELECT id, nav_name
            FROM cms_nav
            WHERE pid = 0
            ORDER BY sort ASC
            LIMIT 0, " . NAV_SIZE;

        return parent::all($_sql);
    }
}