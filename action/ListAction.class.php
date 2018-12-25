<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/24
 * Time: 下午2:34
 */
class ListAction extends Action {

    // 构造方法，初始化
    public function __construct(&$_tpl) {
        parent::__construct($_tpl);
    }

    // 获取前台显示的导航
    public function getNav() {
        if (isset($_GET['id'])) {
            $_nav = new NavModel();
            $_nav->id = $_GET['id'];
            $_navMain = $_nav->getOneNav();
            if ($_navMain) {
                $_nav_p_c = '';
                if ($_navMain->p_id) {
                    $_nav_p = '<a href="list.php?id=' . $_navMain->p_id . '">' . $_navMain->p_nav_name . '</a> &gt; ';
                    $_nav_p_c = $_nav_p;
                }
                $_nav_c = '<a href="list.php?id=' . $_navMain->id . '">' . $_navMain->nav_name . '</a>';
                $_nav_p_c .= $_nav_c;
                // 主导航
                $this->_tpl->assign('nav', $_nav_p_c);

                // 子导航
                $_navChild = $_nav->getAllChildFrontNav();
                $this->_tpl->assign('childNav', $_navChild);
            } else {
                Tool::alertBack('警告：此导航不存在！');
            }
        } else {
            Tool::alertBack('警告：非法操作！');
        }
    }
}