<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/10
 * Time: 下午2:34
 */
class LoginAction extends Action {

    // 构造方法，初始化
    public function __construct(&$_tpl) {
        $_model = new ManageModel();
        parent::__construct($_tpl, $_model);
    }

    // 业务逻辑控制器
    public function _action(){
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            var_dump($action);
            switch(strtolower($action)){
                case 'login':
                    $this->login();
                    break;
                case 'logout':
                    $this->logout();
                    break;
            }
        }
    }

    // login
    private function login() {
        if (isset($_POST['send'])) {
            if(Validate::checkNull($_POST['admin_user'])) Tool::alertBack('警告：用户名不能为空！');
            if(Validate::checkLength($_POST['admin_user'], 2, 'min')) Tool::alertBack('警告：用户名不能小于2位！');
            if(Validate::checkLength($_POST['admin_user'], 20, 'max')) Tool::alertBack('警告：用户名不能大于20位！');
            if(Validate::checkNull($_POST['admin_pass'])) Tool::alertBack('警告：密码不能为空！');
            if(Validate::checkLength($_POST['admin_pass'], 6, 'min')) Tool::alertBack('警告：密码不能小于6位！');
            if(Validate::checkLength($_POST['code'], 4, 'equals')) Tool::alertBack('警告：验证码必须是4位！');
            if(Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])) Tool::alertBack('警告：验证码不正确！');

            $this->_model->admin_user = $_POST['admin_user'];
            $this->_model->admin_pass = sha1($_POST['admin_pass']);
            $_login = $this->_model->getLoginManage();
            if($_login) {
                $_SESSION['admin']['admin_user'] = $_login->admin_user;
                $_SESSION['admin']['level_name'] = $_login->level_name;
                Tool::alertLocation(null, 'admin.php');
            } else {
                Tool::alertBack('警告：用户名或密码错误！');
            }
        }
    }

    // logout
    private function logout() {
        Tool::unSession();
        Tool::alertLocation(null, 'admin_login.php');
    }
}