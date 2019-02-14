<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/24
 * Time: 下午2:34
 */
class DetailsAction extends Action {
    private $id;

    // 构造方法，初始化
    public function __construct(&$_tpl) {
        parent::__construct($_tpl);
    }

    // 执行
    public function action() {
        $this->getDetails();
    }

    // 获取文档的详细内容
    private function getDetails() {
        if (isset($_GET['id'])) {
            $_m_content = new ContentModel();
            parent::__construct($this->_tpl, $_m_content);
            $this->_model->id = $_GET['id'];

            $_content = $this->_model->getOneContent();
            if (! $_content) Tool::alertBack('警告：此文档不存在！');
            $this->_tpl->assign('titlec', $_content->title);
            $this->_tpl->assign('date', $_content->date);
            $this->_tpl->assign('source', $_content->source);
            $this->_tpl->assign('author', $_content->author);
            $this->_tpl->assign('count', $_content->count);
            $this->_tpl->assign('info', $_content->info);
            $this->_tpl->assign('content', Tool::unHtml($_content->content));

            $this->getNav($_content->nav);
        } else {
            Tool::alertBack('警告：非法操作！');
        }
    }

    // 获取前台显示的导航
    private function getNav($_id) {
        $_nav = new NavModel();
        $_nav->id = $_id;
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
    }
}