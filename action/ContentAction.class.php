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
        $this->_tpl->assign('add', true);
        $this->_tpl->assign('title', '新增文档');
    }

    // update
    private function update(){

    }

    // delete
    private function delete(){

    }
}