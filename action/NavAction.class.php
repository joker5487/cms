<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/10
 * Time: 下午2:34
 */
class NavAction extends Action {

    // 构造方法，初始化
    public function __construct(&$_tpl) {
        parent::__construct($_tpl, new NavModel());

        $this->_tpl->assign('show', false);
        $this->_tpl->assign('add', false);
        $this->_tpl->assign('update', false);
        $this->_tpl->assign('delete', false);
        $this->_tpl->assign('addchild', false);
        $this->_tpl->assign('showchild', false);
    }

    // 业务逻辑控制器
    public function _action(){
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
            case 'addchild':
                $this->addchild();
                break;
            case 'showchild':
                $this->showchild();
                break;
            default:
                Tool::alertBack('非法操作！');
                break;
        }
    }


    // show
    private function show(){
        $_page = new Page($this->_model->getNavTotal(), PAGE_SIZE);
        $this->_model->limit = $_page->limit;

        $this->_tpl->assign('show', true);
        $this->_tpl->assign('title', '导航列表');
        $this->_tpl->assign('AllNav', $this->_model->getAllNav());
        $this->_tpl->assign('page', $_page->showPage());
    }

    // add
    private function add(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['nav_name'])) Tool::alertBack('警告：导航名称不能为空！');
            if(Validate::checkLength($_POST['nav_name'], 2, 'min')) Tool::alertBack('警告：导航名称不能小于2位！');
            if(Validate::checkLength($_POST['nav_name'], 20, 'max')) Tool::alertBack('警告：导航名称不能大于20位！');
            if(Validate::checkLength($_POST['nav_name'], 200, 'max')) Tool::alertBack('警告：导航描述不能大于200位！');

            $this->_model->pid = $_POST['pid'];
            $this->_model->nav_name = $_POST['nav_name'];
            if($this->_model->getOneNav()) Tool::alertBack('警告：此导航名称已经被占用！');

            $_returnUrl = $this->_model->pid ? 'nav.php?action=showchild&id=' . $this->_model->pid : 'nav.php?action=show';
            $this->_model->nav_info = $_POST['nav_info'];
            $this->_model->addNav() ? Tool::alertLocation('恭喜您，新增导航成功！', $_returnUrl) : Tool::alertBack('很遗憾，新增导航失败！');
        }
        $this->_tpl->assign('add', true);
        $this->_tpl->assign('title', '新增导航');
    }

    // update
    private function update(){
        if (isset($_POST['send'])) {
            if(Validate::checkNull($_POST['nav_name'])) Tool::alertBack('警告：导航名称不能为空！');
            if(Validate::checkLength($_POST['nav_name'], 2, 'min')) Tool::alertBack('警告：导航名称不能小于2位！');
            if(Validate::checkLength($_POST['nav_name'], 20, 'max')) Tool::alertBack('警告：导航名称不能大于20位！');
            if(Validate::checkLength($_POST['nav_info'], 200, 'max')) Tool::alertBack('警告：导航描述不能大于200位！');

            $this->_model->id = $_POST['id'];
            $this->_model->nav_name = $_POST['nav_name'];
            $this->_model->nav_info = $_POST['nav_info'];
            $this->_model->updateNav() ? Tool::alertLocation('恭喜您，修改导航成功！', 'nav.php?action=show') : Tool::alertBack('很遗憾，修改导航失败！');
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_nav_info = $this->_model->getOneNav();
            is_object($_nav_info) ? true : Tool::alertBack('导航传值的ID有误');
            $this->_tpl->assign('id', $_nav_info->id);
            $this->_tpl->assign('nav_name', $_nav_info->nav_name);
            $this->_tpl->assign('nav_info', $_nav_info->nav_info);
            $this->_tpl->assign('update', true);
            $this->_tpl->assign('title', '修改导航');
        } else {
            Tool::alertBack('非法操作！');
        }
    }

    // delete
    private function delete(){
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $this->_model->deleteNav() ? Tool::alertLocation('恭喜您，删除导航成功！', 'nav.php?action=show') : Tool::alertBack('很遗憾，删除导航失败！');
        } else {
            Tool::alertBack('非法操作！');
        }
        $this->_tpl->assign('delete', true);
        $this->_tpl->assign('title', '删除导航');
    }

    // addchild
    private function addchild() {
        if (isset($_POST['send'])) {
            $this->add();
        }
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];
            $_nav_info = $this->_model->getOneNav();
            is_object($_nav_info) ? true : Tool::alertBack('导航传值的ID有误');

            $this->_tpl->assign('id', $_nav_info->id);
            $this->_tpl->assign('prev_name', $_nav_info->nav_name);
            $this->_tpl->assign('addchild', true);
            $this->_tpl->assign('title', '新增子导航');
        }
    }

    // showchild
    private function showchild() {
        if (isset($_GET['id'])) {
            $this->_model->id = $_GET['id'];

            $_nav_info = $this->_model->getOneNav();
            is_object($_nav_info) ? true : Tool::alertBack('导航传值的ID有误');

            $_page = new Page($this->_model->getNavChildTotal(), PAGE_SIZE);
            $this->_model->limit = $_page->limit;

            $this->_tpl->assign('id', $_GET['id']);
            $this->_tpl->assign('showchild', true);
            $this->_tpl->assign('title', '子导航列表');
            $this->_tpl->assign('AllChildNav', $this->_model->getAllChildNav());
            $this->_tpl->assign('prev_name', $_nav_info->nav_name);

            $this->_tpl->assign('page', $_page->showPage());
        }
    }

    /* ================================================== 分割线：前台页面使用 ================================================== */

    public function showfront() {
        $this->_tpl->assign('frontNav', $this->_model->getFrontNav());
    }
}