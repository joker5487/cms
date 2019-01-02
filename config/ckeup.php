<?php

/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/28
 * Time: 下午6:27
 */

require substr(dirname(__FILE__), 0, -7) . '/init.inc.php';

if (isset($_GET['type'])) {
    $_maxsize = isset($_POST['MAX_FILE_SIZE']) ? $_POST['MAX_FILE_SIZE'] : MAX_FILE_SIZE;
    $_fileUpload = new FileUpload('upload', $_maxsize);

    $_ckefn = $_GET['CKEditorFuncNum'];
    $_path = $_fileUpload->getPath();

    $_img = new Image($_path);
    $_img->ckeImg();

    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($_ckefn, \"$_path\", '图片上传成功！')</script>";
} else {
    Tool::alertBack('警告：因为非法操作导致上传失败！');
}