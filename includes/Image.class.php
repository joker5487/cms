<?php
/**
 * 图像处理类
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/29
 * Time: 下午4:23
 */
class Image {
    private $file;          // 图片地址
    private $width;         // 图片宽度
    private $height;        // 图片高度
    private $type;          // 图片类型
    private $img;           // 原图片资源句柄
    private $new;           // 新图片资源句柄

    // 构造方法，初始化
    public function __construct($_file) {
        // 获取图片的磁盘路径（硬路径）
        $this->file = $_SERVER['DOCUMENT_ROOT'] . $_file;

        // 获取图片的宽度、高度、类型
        list($this->width, $this->height, $this->type) = getimagesize($this->file);

        // 获取原图片资源句柄
        $this->img = $this->getFromImg($this->file, $this->type);
    }

    // cke专用图像处理
    public function ckeImg($new_width = 0, $new_height = 0) {
        $_markPath = '..' . MARK;
        list($_water_width, $_water_height, $_water_type) = getimagesize($_markPath);
        $_water = $this->getFromImg($_markPath, $_water_type);
        
        // check
        if (empty($new_width) && empty($new_height)) {
            $new_width = $this->width;
            $new_height = $this->height;
        }
        if (! is_numeric($new_width) || ! is_numeric($new_height)) {
            $new_width = $this->width;
            $new_height = $this->height;
        }
        if ($this->width > $new_width) {
            $new_height = ($new_width / $this->width) * $this->height;
        } else {
            $new_width = $this->width;
            $new_height = $this->height;
        }
        if ($this->height > $new_height) {
            $new_width = ($new_height / $this->height) * $this->width;
        } else {
            $new_width = $this->width;
            $new_height = $this->height;
        }

        $_padding = 5;
        $_water_x = $new_width - $_water_width - $_padding;
        $_water_y = $new_height - $_water_height - $_padding;

        // 新图背景资源句柄
        $this->new = imagecreatetruecolor($new_width, $new_height);

        // 防止透明背景的图片缩略之后背景变成黑色
        $this->original_background();

        // copy 原图到新图背景中
        imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);

        imagecopy($this->new, $_water, $_water_x, $_water_y, 0, 0, $_water_width, $_water_height);
        imagepng($this->new, $this->file);
        imagedestroy($this->img);
        imagedestroy($_water);
    }

    // 缩略图（固定容器的长和高、图像等比例、扩容、填充、裁剪）
    public function thumb($new_width = 0, $new_height = 0) {
        // check
        if (empty($new_width) && empty($new_height)) {
            $new_width = $this->width;
            $new_height = $this->height;
        }
        if (! is_numeric($new_width) || ! is_numeric($new_height)) {
            $new_width = $this->width;
            $new_height = $this->height;
        }

        // 创建一个容器
        $_n_w = $new_width;
        $_n_h = $new_height;

        // 创建裁剪点
        $_cut_width = 0;
        $_cut_height = 0;

        // 图像等比例
        if ($this->width < $this->height) {
            $new_width = ($new_height / $this->height) * $this->width;
        } else {
            $new_height = ($new_width / $this->width) * $this->height;
        }

        // 获取裁剪点坐标信息
        if ($new_width < $_n_w) { // 如果新宽度小于新容器的宽度
            $r = $_n_w / $new_width; // 按宽度求出等比例因子
            $new_width *= $r; // 扩展填充后的宽度
            $new_height *= $r; // 扩展填充后的高度
            $_cut_height = ($this->height - $_n_w) / 4; // 求出裁剪点的高度
        }
        if ($new_height < $_n_h) { // 如果新高度小于新容器的高度
            $r = $_n_h / $new_height; // 按高度求出等比例因子
            $new_width *= $r; // 扩展填充后的宽度
            $new_height *= $r; // 扩展填充后的高度
            $_cut_width = ($this->width - $_n_h) / 4; // 求出裁剪点的宽度
        }

        // 新图背景资源句柄
        $this->new = imagecreatetruecolor($new_width, $new_height);

        // 防止透明背景的图片缩略之后背景变成黑色
        $this->original_background();

        // copy 原图到新图背景中
        imagecopyresampled($this->new, $this->img, 0, 0, $_cut_width, $_cut_height, $new_width, $new_height, $this->width, $this->height);
    }

    // 缩略图（等比例）
    public function thumb_ratio($new_width, $new_height) {
        if ($this->width < $this->height) {
            $new_width = ($new_height / $this->height) * $this->width;
        } else {
            $new_height = ($new_width / $this->width) * $this->height;
        }

        // 新图背景资源句柄
        $this->new = imagecreatetruecolor($new_width, $new_height);

        // 防止透明背景的图片缩略之后背景变成黑色
        $this->original_background();

        // copy 原图到新图背景中
        imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
    }

    // 缩略图（百分比）
    public function thumb_percentage($_per) {
        $new_width = $this->width * ($_per / 100);
        $new_height = $this->height * ($_per / 100);

        // 新图背景资源句柄
        $this->new = imagecreatetruecolor($new_width, $new_height);

        // 防止透明背景的图片缩略之后背景变成黑色
        $this->original_background();

        // copy 原图到新图背景中
        imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
    }

    // 图片输出
    public function out() {
        // 输出图片
        imagepng($this->new, $this->file);

        // 销毁资源句柄
        imagedestroy($this->img);
        imagedestroy($this->new);
    }

    // 载入图片、返回图片的资源句柄
    private function getFromImg($_file, $_type) {
        switch ($_type) {
            case 1:
                $img = imagecreatefromgif($_file);
                break;
            case 2:
                $img = imagecreatefromjpeg($_file);
                break;
            case 3:
                $img = imagecreatefrompng($_file);
                break;
            default:
                Tool::alertBack('警告：系统不支持该类型的处理！');
        }

        return $img;
    }

    // 防止透明背景的图片缩略之后背景变成黑色
    private function original_background() {
        // 这里很重要,意思是不合并颜色,直接用原图片图像颜色替换,包括透明色;
        imagealphablending($this->new, false);

        // 这里很重要,意思是不要丢了新图背景图像的透明色;
        imagesavealpha($this->new, true);
    }

}