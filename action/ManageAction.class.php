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

        $this->_tpl->assign('show', false);
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
            case 'show':
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


    // show
    private function show(){
        $_page = new Page($this->_model->getManageTotal(), PAGE_SIZE);
        $this->_model->limit = $_page->limit;

        $this->_tpl->assign('show', true);
        $this->_tpl->assign('title', '管理员列表');
        $this->_tpl->assign('AllManage', $this->_model->getAllManage());
        $this->_tpl->assign('page', $_page->showPage());
    }

    // add
    private function add(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['admin_user'])) Tool::alertBack('警告：用户名不能为空！');
            if(Validate::checkLength($_POST['admin_user'], 2, 'min')) Tool::alertBack('警告：用户名不能小于2位！');
            if(Validate::checkLength($_POST['admin_user'], 20, 'max')) Tool::alertBack('警告：用户名不能大于20位！');
            if(Validate::checkNull($_POST['admin_pass'])) Tool::alertBack('警告：密码不能为空！');
            if(Validate::checkLength($_POST['admin_pass'], 6, 'min')) Tool::alertBack('警告：密码不能小于6位！');
            if(Validate::checkEquals($_POST['admin_pass'], $_POST['admin_notpass'])) Tool::alertBack('警告：密码和密码确认必须一致！');

            $this->_model->admin_user = $_POST['admin_user'];
            if($this->_model->getOneManage()) Tool::alertBack('警告：此用户名已经被占用！');

            $this->_model->admin_pass = sha1($_POST['admin_pass']);
            $this->_model->level = $_POST['level'];
            $this->_model->addManage() ? Tool::alertLocation('恭喜您，新增管理员成功！', 'manage.php?action=show') : Tool::alertBack('很遗憾，新增管理员失败！');
        }
        $this->_tpl->assign('add', true);
        $this->_tpl->assign('title', '新增管理员');

        $_level = new LevelModel();
        $this->_tpl->assign('allLevel', $_level->getAllLevel());
    }

    // update
    private function update(){
        if (isset($_POST['send'])) {
            $this->_model->id = $_POST['id'];
            $this->_model->admin_user = $_POST['admin_user'];
            if (trim($_POST['admin_pass']) == '') {
                $this->_model->admin_pass = $_POST['pass'];
            } else {
                if(Validate::checkLength($_POST['admin_pass'], 6, 'min')) Tool::alertBack('警告：密码不能小于6位！');
                $this->_model->admin_pass = sha1($_POST['admin_pass']);
            }
            $this->_model->level = $_POST['level'];
            $this->_model->updateManage() ? Tool::alertLocation('恭喜您，修改管理员成功！', 'manage.php?action=show') : Tool::alertBack('很遗憾，修改管理员失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_manage_info = $this->_model->getOneManage();
            is_object($_manage_info) ? true : Tool::alertBack('管理员传值的ID有误');
            $this->_tpl->assign('id', $_manage_info->id);
            $this->_tpl->assign('level', $_manage_info->level);
            $this->_tpl->assign('admin_user', $_manage_info->admin_user);
            $this->_tpl->assign('admin_pass', $_manage_info->admin_pass);
            $this->_tpl->assign('update', true);
            $this->_tpl->assign('title', '修改管理员');

            $_level = new LevelModel();
            $this->_tpl->assign('allLevel', $_level->getAllLevel());
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // delete
    private function delete(){
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $this->_model->deleteManage() ? Tool::alertLocation('恭喜您，删除管理员成功！', 'manage.php?action=show') : Tool::alertBack('很遗憾，删除管理员失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
        $this->_tpl->assign('delete', true);
        $this->_tpl->assign('title', '删除管理员');
    }
}