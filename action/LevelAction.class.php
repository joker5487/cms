<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/10
 * Time: 下午2:34
 */
class LevelAction extends Action {

    // 构造方法，初始化
    public function __construct(&$_tpl) {
        Validate::checkSession();
        parent::__construct($_tpl, new LevelModel());

        $this->_tpl->assign('show', false);
        $this->_tpl->assign('add', false);
        $this->_tpl->assign('update', false);
        $this->_tpl->assign('delete', false);

        $this->_action();
        $this->_tpl->display('level.tpl');
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
        $_page = new Page($this->_model->getLevelTotal(), PAGE_SIZE);
        $this->_model->limit = $_page->limit;

        $this->_tpl->assign('show', true);
        $this->_tpl->assign('title', '等级列表');
        $this->_tpl->assign('AllLevel', $this->_model->getAllLevel());
        $this->_tpl->assign('page', $_page->showPage());
    }

    // add
    private function add(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['level_name'])) Tool::alertBack('警告：等级名称不能为空！');
            if(Validate::checkLength($_POST['level_name'], 2, 'min')) Tool::alertBack('警告：等级名称不能小于2位！');
            if(Validate::checkLength($_POST['level_name'], 20, 'max')) Tool::alertBack('警告：等级名称不能大于20位！');
            if(Validate::checkLength($_POST['level_info'], 200, 'max')) Tool::alertBack('警告：等级描述不能大于200位！');

            $this->_model->level_name = $_POST['level_name'];
            if($this->_model->getOneLevel()) Tool::alertBack('警告：此等级名称已经被占用！');

            $this->_model->level_info = $_POST['level_info'];
            $this->_model->addLevel() ? Tool::alertLocation('恭喜您，新增等级成功！', 'level.php?action=show') : Tool::alertBack('很遗憾，新增等级失败！');
        }
        $this->_tpl->assign('add', true);
        $this->_tpl->assign('title', '新增等级');
    }

    // update
    private function update(){
        if (isset($_POST['send'])) {
            if(Validate::checkNull($_POST['level_name'])) Tool::alertBack('警告：等级名称不能为空！');
            if(Validate::checkLength($_POST['level_name'], 2, 'min')) Tool::alertBack('警告：等级名称不能小于2位！');
            if(Validate::checkLength($_POST['level_name'], 20, 'max')) Tool::alertBack('警告：等级名称不能大于20位！');
            if(Validate::checkLength($_POST['level_info'], 200, 'max')) Tool::alertBack('警告：等级描述不能大于200位！');

            $this->_model->id = $_POST['id'];
            $this->_model->level_name = $_POST['level_name'];
            $this->_model->level_info = $_POST['level_info'];
            $this->_model->updateLevel() ? Tool::alertLocation('恭喜您，修改等级成功！', 'level.php?action=show') : Tool::alertBack('很遗憾，修改等级失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_level_info = $this->_model->getOneLevel();
            is_object($_level_info) ? true : Tool::alertBack('等级传值的ID有误');
            $this->_tpl->assign('id', $_level_info->id);
            $this->_tpl->assign('level_name', $_level_info->level_name);
            $this->_tpl->assign('level_info', $_level_info->level_info);
            $this->_tpl->assign('update', true);
            $this->_tpl->assign('title', '修改等级');
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // delete
    private function delete(){
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $_manage = new ManageModel();
            $_manage->level = $this->_model->id;
            if($_manage->getOneManage()) Tool::alertBack('警告：此等级已有管理员使用，无法删除，请先删除对应的管理员！');
            $this->_model->deleteLevel() ? Tool::alertLocation('恭喜您，删除等级成功！', 'level.php?action=show') : Tool::alertBack('很遗憾，删除等级失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
        $this->_tpl->assign('delete', true);
        $this->_tpl->assign('title', '删除等级');
    }
}