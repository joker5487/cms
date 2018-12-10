<?php

/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/6
 * Time: 下午5:01
 */

// 管理员实体类
class Manage
{
    private $_tpl;
    private $id;
    private $admin_user;
    private $admin_pass;
    private $level;

    public function __construct(&$_tpl) {
        $this->_tpl = $_tpl;
        $this->Action();
    }

    public function Action() {
        // 业务逻辑控制器
        $action = $_GET['action'];
        $this->_tpl->assign('list', false);
        $this->_tpl->assign('add', false);
        $this->_tpl->assign('update', false);
        $this->_tpl->assign('delete', false);
        switch(strtolower($action)){
            case 'list':
                $this->_tpl->assign('list', true);
                $this->_tpl->assign('title', '管理员列表');
                $this->_tpl->assign('AllManage', $this->getManage());
                break;
            case 'add':
                if(isset($_POST['send'])){
                    $this->admin_user = $_POST['admin_user'];
                    $this->admin_pass = sha1($_POST['admin_pass']);
                    $this->level = $_POST['level'];
                    $this->addManage() ? Tool::alertLocation('恭喜您，新增管理员成功！', 'manage.php?action=list') : Tool::alertBack('很遗憾，新增管理员失败！');
                }
                $this->_tpl->assign('add', true);
                $this->_tpl->assign('title', '新增管理员');
                break;
            case 'update':
                if (isset($_POST['send'])) {
                    $this->id = $_POST['id'];
                    $this->admin_user = $_POST['admin_user'];
                    $this->admin_pass = sha1($_POST['admin_pass']);
                    $this->level = $_POST['level'];
                    $this->updateManage() ? Tool::alertLocation('恭喜您，修改管理员成功！', 'manage.php?action=list') : Tool::alertBack('很遗憾，修改管理员失败！');
                }
                if (isset($_GET['id'])) {
                    $this->id = $_GET['id'];
                    $_manage_info = $this->getOneManage();
                    is_object($_manage_info) ? true : Tool::alertBack('管理员传值的ID有误');
                    $this->_tpl->assign('id', $_manage_info->id);
                    $this->_tpl->assign('level', $_manage_info->level);
                    $this->_tpl->assign('admin_user', $_manage_info->admin_user);
                } else {
                    Tool::alertBack('非法操作！');
                }
                $this->_tpl->assign('update', true);
                $this->_tpl->assign('title', '修改管理员');
                break;
            case 'delete':
                if(isset($_GET['id'])){
                    $this->id = $_GET['id'];
                    $this->deleteManage() ? Tool::alertLocation('恭喜您，删除管理员成功！', 'manage.php?action=list') : Tool::alertBack('很遗憾，删除管理员失败！');
                } else {
                    Tool::alertBack('非法操作！');
                }
                $this->_tpl->assign('delete', true);
                $this->_tpl->assign('title', '删除管理员');
                break;
            default:
                break;
        }
        $this->_tpl->display('manage.tpl');
    }

    // 查询单个管理员
    public function getOneManage() {
        $_db = DB::getDB();
        $_sql = "
            SELECT
                id,
                admin_user,
                level
            FROM
                cms_manage
            WHERE
                id = '$this->id'
            LIMIT 1
        ";

        // 获取结果集
        $_result = $_db->query($_sql);
        $_object = $_result->fetch_object();

        DB::unDB($_result, $_db);

        return $_object;
    }

    // 查询所有管理员
    public function getManage() {
        $_db = DB::getDB();
        // 设置查询逻辑
        $_sql = "
          SELECT
            m.id,
            m.admin_user,
            m.level,
            m.login_count,
            m.last_ip,
            m.last_time,
            l.level_name
          FROM cms_manage m
          LEFT JOIN cms_level l ON m.level = l.level
          ORDER BY m.id ASC
        ";
        // 获取结果集
        $_result = $_db->query($_sql);

        $_list = [];
        while($_object = $_result->fetch_object()) {
            $_list[] = $_object;
        }

        DB::unDB($_result, $_db);

        return $_list;
    }

    // 新增管理员
    public function addManage() {
        $_db = DB::getDB();
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
        $_db->query($_sql);
        $_affected_rows = $_db->affected_rows;
        $_result = null;
        DB::unDB($_result, $_db);

        return $_affected_rows;
    }

    // 修改管理员
    public function updateManage() {
        $_db = DB::getDB();
        $_sql = "
            UPDATE cms_manage
            SET
              admin_user = '$this->admin_user',
              admin_pass = '$this->admin_pass',
              level = '$this->level'
            WHERE id = '$this->id'
            LIMIT 1
        ";

        $_db->query($_sql);
        $_affected_rows = $_db->affected_rows;
        $_result = null;
        DB::unDB($_result, $_db);

        return $_affected_rows;
    }

    // 删除管理员
    public function deleteManage() {
        $_db = DB::getDB();
        $_sql = "DELETE FROM cms_manage WHERE id = '$this->id' LIMIT 1";
        $_db->query($_sql);
        $_affected_rows = $_db->affected_rows;
        DB::unDB($_result = null, $_db);

        return $_affected_rows;
    }
}