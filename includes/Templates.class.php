<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/11/28
 * Time: 下午4:03
 */

// 模版类

class Templates {

    // 成员变量
    private $_vars = [];
    private $_config = [];

    // 构造方法，验证目录是否存在
    public function __construct()
    {
        if(! is_dir(TPL_DIR) || ! is_dir(TPL_C_DIR) || !is_dir(CACHE))
        {
            exit('ERROR: 文件夹不存在，请手动创建！');
        }

        // 保存系统变量
        $_sxe = simplexml_load_file(ROOT_PATH . '/config/profile.xml');
        $_tagLib = $_sxe->xpath('/root/taglib');
        foreach ( $_tagLib as $_tag ) {
            $this->_config["$_tag->name"] = $_tag->value;
        }
    }

    // 注入变量
    public function assign($_var, $_value){
        // $_var 作为 key ，所以必传 且 不能为空
        if( ! isset($_var) || empty($_var)){
            exit('ERROR: 请设置模版变量！');
        }

        $this->_vars[$_var] = $_value;
    }

    // 页面渲染方法
    public function display($_file){
        // 给include进来的tpl传一个模板操作的对象
        $_tpl = $this;
        // 设置模版路径
        $_tplFile = TPL_DIR . $_file;

        // 判断模版文件是否存在
        if( ! file_exists($_tplFile)){
            exit('模版文件不存在！');
        }

        // 生成编译文件
        $_parFile = TPL_C_DIR . md5($_file) . $_file . '.php';

        // 缓存文件
        $_cacheFile = CACHE . md5($_file) . $_file . '.html';

        // 当缓冲区开启 且 非首次加载运行文件时，直接加载缓存文件，避开编译
        if(IS_CACHE){
            // 判断缓存文件和编译文件是否同时存在，如果不同时存在，需要重新编译
            if(file_exists($_parFile) && file_exists($_cacheFile)){
                // 判断模版文件 和 编译文件是否存在修改
                if(filemtime($_parFile) >= filemtime($_tplFile) || filemtime($_cacheFile) >= filemtime($_parFile)){
                    // 直接载入缓存文件
                    include $_cacheFile;
                    return;
                }
            }
        }

        // 如果编译文件不存在，或者编译文件的修改时间小于模版文件的修改时间，则重新编译
        if( ! file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)){
            // 引入模版解析类
            require_once ROOT_PATH . '/includes/Parser.class.php';

            // 实例化
            $_parser = new Parser($_tplFile);
            $_parser->compile($_parFile);
        }

        // 载入编译文件
        include $_parFile;

        // 如果开启缓冲区，则写入缓存文件并载入
        if(IS_CACHE){
            // 写入缓存文件
            file_put_contents($_cacheFile, ob_get_contents());

            // 清除缓冲区内容
            ob_end_clean();

            // 载入缓存文件
            include $_cacheFile;
        }
    }

    // 创建 create 方法，用于 header 和 footer 模块解析使用，不需要生成缓存文件
    public function create($_file){
        // 设置模版路径
        $_tplFile = TPL_DIR . $_file;

        // 判断模版文件是否存在
        if( ! file_exists($_tplFile)){
            exit('模版文件不存在！');
        }

        // 生成编译文件
        $_parFile = TPL_C_DIR . md5($_file) . $_file . '.php';

        // 如果编译文件不存在，或者编译文件的修改时间小于模版文件的修改时间，则重新编译
        if( ! file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)){
            // 引入模版解析类
            require_once ROOT_PATH . '/includes/Parser.class.php';

            // 实例化
            $_parser = new Parser($_tplFile);
            $_parser->compile($_parFile);
        }

        // 载入编译文件
        include $_parFile;
    }

}