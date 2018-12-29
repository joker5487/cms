<?php
/**
 * 上传文件类
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/27
 * Time: 下午1:33
 */

class FileUpload {
    private $error;         // 错误代码
    private $maxsize;       // 表单最大值
    private $type;          // 上传文件类型
    private $typeArr = ['image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif'];
    private $path;          // 上传路径
    private $today;         // 当天路径
    private $name;          // 上传文件的名称
    private $tmp;           // 临时文件
    private $linkPath;      // 链接路径
    private $linkToday;     // 当天路径（相对路径）

    // 构造方法，初始化
    public function __construct($_file, $_maxsize) {
        $this->error = $_FILES[$_file]['error'];
        $this->maxsize = $_maxsize / 1024;
        $this->type = $_FILES[$_file]['type'];
        $this->path = ROOT_PATH . UPDIR;
        $this->linkToday = date('Ymd') . '/';
        $this->today = $this->path . $this->linkToday;
        $this->name = $_FILES[$_file]['name'];
        $this->tmp = $_FILES[$_file]['tmp_name'];

        $this->checkError();
        $this->checkType();
        $this->checkPath();
        $this->setNewName();
        $this->moveUpload();
    }

    // 返回链接路径
    public function getPath() {
        $_path = $_SERVER['SCRIPT_NAME'];
        $_dir = dirname(dirname($_path));
        if ($_dir == '\\') $_dir = '/';

        $this->linkPath = $_dir . $this->linkPath;

        return $this->linkPath;
    }

    // 移动文件
    private function moveUpload() {
        if (is_uploaded_file($this->tmp)) {
            if (! move_uploaded_file($this->tmp, $this->setNewName())) {
                Tool::alertBack('警告：上传文件失败！');
            }
        } else {
            Tool::alertBack('警告：临时文件不存在！');
        }
    }

    // 设置新文件名
    private function setNewName() {
        $_nameArr = explode('.', $this->name);
        $_suffix = $_nameArr[count($_nameArr) - 1];
        $_newName = date('YmdHis') . mt_rand(100, 1000) . '.' . $_suffix;

        $this->linkPath = UPDIR . $this->linkToday . $_newName;

        return $this->today . $_newName;
    }

    // 验证路径
    private function checkPath() {
        if (! is_dir($this->path) || ! is_writable($this->path)) {
            if (! mkdir($this->path)) {
                Tool::alertBack('警告：主目录创建失败！');
            }
        }

        if (! is_dir($this->today) || ! is_writable($this->today)) {
            if (! mkdir($this->today)) {
                Tool::alertBack('警告：子目录创建失败！');
            }
        }
    }

    // 验证类型
    private function checkType() {
        if (! in_array($this->type, $this->typeArr)) {
            Tool::alertBack('警告：不合法的上传类型！');
        }
    }

    // 验证错误
    private function checkError() {
        if (! empty($this->error)) {
            switch ($this->error) {
                case 1:
                    Tool::alertBack('警告：上传文件大小超过了约定的最大值！');
                    break;
                case 2:
                    Tool::alertBack('警告：上传文件大小超过了 ' . $this->maxsize . ' KB！');
                    break;
                case 3:
                    Tool::alertBack('警告：只有部分文件被上传！');
                    break;
                case 4:
                    Tool::alertBack('警告：没有任何文件被上传！');
                    break;
                default:
                    Tool::alertBack('警告：发生未知错误！');
                    break;
            }
        }
    }
}