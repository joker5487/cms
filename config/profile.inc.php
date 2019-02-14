<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/11/30
 * Time: 下午5:07
 */

// 数据库配置信息
define('DB_HOST', 'localhost');                             // 主机IP
define('DB_USER', 'root');                                  // 数据库连接用户名
define('DB_PASS', '');                                      // 数据库连接密码
define('DB_NAME', 'cms');                                   // 数据库名称

// 模版配置信息
define('TPL_DIR', ROOT_PATH . '/templates/');               // 模版文件目录
define('TPL_C_DIR', ROOT_PATH . '/templates_c/');           // 编译文件目录
define('CACHE', ROOT_PATH . '/cache/');                     // 缓存文件目录
define('UPDIR', '/uploads/');                               // 上传文件目录
define('MARK', '/images/yc.png');                           // 水印图片地址
define('MAX_FILE_SIZE', 204800);                            // 图片上传允许的最大值（KB）

// 系统配置信息
define('PAGE_SIZE', 10);                                    // 分页：每页显示记录数(后台列表)
define('ARTICLE_SIZE', 8);                                  // 分页：每页显示记录数(前台文档列表)
define('GPC', get_magic_quotes_gpc());                      // mysql 是否开启自动转义，1 开启， 0 未开启
define('NAV_SIZE', 10);                                     // 前台主导航显示个数
