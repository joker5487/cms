<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/10
 * Time: 下午2:34
 */
class ManageAction extends Action {

    // 构造方法，初始化
    public function __construct(&$_tpl) {
        parent::__construct($_tpl, new ManageModel());

        $this->_tpl->assign('list', false);
        $this->_tpl->assign('add', false);
        $this->_tpl->assign('update', false);
        $this->_tpl->assign('delete', false);

        $this->_action();
        $this->_tpl->display('manage.tpl');
    }

    // 业务逻辑控制器
    private function _action(){
        $action = $_GET['action'];
        switch(strtolower($action)){
            case 'list':
                $this->show();
                break;
            case 'add':
                $this->add();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                Tool::alertBack('非法操作！');
                break;
        }
    }


    // list
    private function show(){
        $this->_tpl->assign('list', true);
        $this->_tpl->assign('title', '管理员列表');
        $this->_tpl->assign('AllManage', $this->_model->getManage());
    }

    // add
    private function add(){
        if(isset($_POST['send'])){
            $this->_model->admin_user = $_POST['admin_user'];
            $this->_model->admin_pass = sha1($_POST['admin_pass']);
            $this->_model->level = $_POST['level'];
            $this->_model->addManage() ? Tool::alertLocation('恭喜您，新增管理员成功！', 'manage.php?action=list') : Tool::alertBack('很遗憾，新增管理员失败！');
        }
        $this->_tpl->assign('add', true);
        $this->_tpl->assign('title', '新增管理员');
    }

    // update
    private function update(){
        if (isset($_POST['send'])) {
            $this->_model->id = $_POST['id'];
            $this->_model->admin_user = $_POST['admin_user'];
            $this->_model->admin_pass = sha1($_POST['admin_pass']);
            $this->_model->level = $_POST['level'];
            $this->_model->updateManage() ? Tool::alertLocation('恭喜您，修改管理员成功！', 'manage.php?action=list') : Tool::alertBack('很遗憾，修改管理员失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_manage_info = $this->_model->getOneManage();
            is_object($_manage_info) ? true : Tool::alertBack('管理员传值的ID有误');
            $this->_tpl->assign('id', $_manage_info->id);
            $this->_tpl->assign('level', $_manage_info->level);
            $this->_tpl->assign('admin_user', $_manage_info->admin_user);
        } else {
            Tool::alertBack('非法操作！');
        }
        $this->_tpl->assign('update', true);
        $this->_tpl->assign('title', '修改管理员');
    }

    // delete
    private function delete(){
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $this->_model->deleteManage() ? Tool::alertLocation('恭喜您，删除管理员成功！', 'manage.php?action=list') : Tool::alertBack('很遗憾，删除管理员失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
        $this->_tpl->assign('delete', true);
        $this->_tpl->assign('title', '删除管理员');
    }
}