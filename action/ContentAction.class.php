<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/10
 * Time: 下午2:34
 */
class ContentAction extends Action {

    // 构造方法，初始化
    public function __construct(&$_tpl) {
        $_model = new ContentModel();
        parent::__construct($_tpl, $_model);

        $this->_tpl->assign('show', false);
        $this->_tpl->assign('add', false);
        $this->_tpl->assign('update', false);
        $this->_tpl->assign('delete', false);
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
            default:
                Tool::alertBack('非法操作！');
                break;
        }
    }


    // show
    private function show(){
        $this->_tpl->assign('show', true);
        $this->_tpl->assign('title', '文档列表');
    }

    // add
    private function add(){
        if (isset($_POST['send'])) {
            // check
            if (Validate::checkNull($_POST['title'])) Tool::alertBack('警告：标题不能为空！');
            if (Validate::checkLength($_POST['title'], 2, 'min')) Tool::alertBack('警告：标题长度不能小于2位！');
            if (Validate::checkLength($_POST['title'], 50, 'max')) Tool::alertBack('警告：标题长度不能大于50位！');
            if (Validate::checkNull($_POST['nav'])) Tool::alertBack('警告：必须选择一个栏目！');
            if (Validate::checkLength($_POST['tag'], 30, 'max')) Tool::alertBack('警告：tag标签长度不能大于30位！');
            if (Validate::checkLength($_POST['keyword'], 30, 'max')) Tool::alertBack('警告：关键字长度不能大于30位！');
            if (Validate::checkLength($_POST['source'], 20, 'max')) Tool::alertBack('警告：文章来源长度不能大于20位！');
            if (Validate::checkLength($_POST['author'], 10, 'max')) Tool::alertBack('警告：作者长度不能大于10位！');
            if (Validate::checkLength($_POST['info'], 200, 'max')) Tool::alertBack('警告：内容摘要长度不能大于200位！');
            if (Validate::checkNull($_POST['content'])) Tool::alertBack('警告：详细内容不能为空！');
            if (Validate::checkNum($_POST['count'])) Tool::alertBack('警告：浏览次数必须是数字！');
            if (Validate::checkNum($_POST['gold'])) Tool::alertBack('警告：消费金币必须是数字！');

            $_attr = '无属性';
            if (isset($_POST['attr'])) {
                $_attr = implode(',', $_POST['attr']);
            }
            $this->_model->title = $_POST['title'];
            $this->_model->nav = $_POST['nav'];
            $this->_model->attr = $_attr;
            $this->_model->tag = $_POST['tag'];
            $this->_model->keyword = $_POST['keyword'];
            $this->_model->thumbnail = $_POST['thumbnail'];
            $this->_model->info = $_POST['info'];
            $this->_model->source = $_POST['source'];
            $this->_model->author = $_POST['author'];
            $this->_model->content = $_POST['content'];
            $this->_model->commend = $_POST['commend'];
            $this->_model->count = $_POST['count'];
            $this->_model->gold = $_POST['gold'];
            $this->_model->color = $_POST['color'];

            $this->_model->addContent() ? Tool::alertLocation('文档发布成功', '?action=add') : Tool::alertBack('文档发布失败');
        }


        $this->_tpl->assign('add', true);
        $this->_tpl->assign('title', '新增文档');
        $_nav = new NavModel();
        $_allFrontNav = $_nav->getAllFrontNav();
        $_html = '';
        foreach ($_allFrontNav as $_object) {
            $_html .= '<optgroup label="' . $_object->nav_name . '">';
            $_nav->id = $_object->id;
            $_allChildFrontNav = $_nav->getAllChildFrontNav();
            if ($_allChildFrontNav) {
                foreach ($_allChildFrontNav as $_object) {
                    $_html .= '<option value="' . $_object->id . '">' . $_object->nav_name . '</option>';
                }
            }
            $_html .= '</optgroup>';
        }
        $this->_tpl->assign('nav', $_html);
        $this->_tpl->assign('author', $_SESSION['admin']['admin_user']);
    }

    // update
    private function update(){

    }

    // delete
    private function delete(){

    }
}