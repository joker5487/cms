<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/12
 * Time: 下午5:11
 */

require substr(dirname(__FILE__), 0, -7) . '/init.inc.php';

if (isset($_POST['send'])) {
    $_maxsize = $_POST['MAX_FILE_SIZE'];
    $_fileUpload = new FileUpload('pic', $_maxsize);
    $_linkPath = $_fileUpload->getPath();

    // 图像处理
    $_img = new Image($_linkPath);
    // 图片输出
    $_img->thumb(150, 100);
    $_img->out();

    Tool::alertOpenerClose('缩略图上传成功！', $_linkPath);
} else {
    Tool::alertBack('警告：文件过大或者发生未知错误，导致浏览器崩溃！');
}