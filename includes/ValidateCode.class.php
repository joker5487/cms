<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/12
 * Time: 下午3:14
 */

// 验证码类
class ValidateCode {
    private $charset = 'abcdefghkmnpqrstuvwxyzABCDEFGHKMNPQRSTUVWXYZ23456789';              // 随机因子
    private $code;                                                                          // 验证码
    private $codeLen = 4;                                                                   // 验证码长度
    private $width = 130;                                                                   // 验证码背景图片宽度
    private $height = 50;                                                                   // 验证码背景图片高度
    private $img;                                                                           // 验证码背景图片资源句柄
    private $font;                                                                          // 指定的字体
    private $fontSize = 20;                                                                 // 指定的字体大小
    private $fontColor;                                                                     // 指定的字体颜色（随机）

    // 构造方法初始化
    public function __construct() {
        $this->font = ROOT_PATH . '/font/elephant.ttf';
    }

    // 生成随机码
    private function createCode() {
        $_len = strlen($this->charset) - 1;
        for ($i = 0; $i < $this->codeLen; $i++) {
            $this->code .= $this->charset[mt_rand(0, $_len)];
        }
        return $this->code;
    }

    // 生成验证码背景图片
    private function createBg() {
        // 生成画布
        $this->img = imagecreatetruecolor($this->width, $this->height);
        // 指定画布的背景颜色
        $color = imagecolorallocate($this->img, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));
        // 生成矩形并填充设置的颜色
        imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);
    }

    // 生成文字
    private function createFont() {
        $_x = $this->width / $this->codeLen;
        for ($i = 0; $i < $this->codeLen; $i++) {
            $this->fontColor = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imagettftext($this->img, $this->fontSize, mt_rand(-30, 30), $_x * $i + mt_rand(3, 8), $this->height / 1.4, $this->fontColor, $this->font, $this->code[$i]);
        }
    }

    // 生成线条和雪花
    private function createLine() {
        // 生成线条
        for ($i = 0; $i < 6; $i++) {
            $_color = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $_color);
        }

        // 生成雪花
        for ($j = 0; $j < 100; $j++) {
            $_color = imagecolorallocate($this->img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
            imagestring($this->img, mt_rand(1, 5), mt_rand(1, $this->width), mt_rand(0, $this->height), '*', $_color);
        }
    }

    // 输出图形
    private function outPut() {
        header('Content-Type:image/png');   // 指定HTTP发送的标头 png
        imagepng($this->img);               // 指定向浏览器输出的类型 png
        imagedestroy($this->img);           // 销毁图形句柄
    }

    // 对外生成验证码
    public function doImg() {
        $this->createBg();
        $this->createCode();
        $this->createLine();
        $this->createFont();
        $this->outPut();
    }

    // 获取验证码
    public function getCode() {
        return strtolower($this->code);
    }
}