<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/11/28
 * Time: 下午4:02
 */

// 模版解析类

class Parser {

    private $_tpl;

    // 构造方法，获取模版文件里面的内容
    public function __construct($_tplFile)
    {
        if( ! $this->_tpl = file_get_contents($_tplFile)){
            exit('ERROR: 模版文件读取错误！');
        }
    }

    // 解析普通变量
    private function parVar(){
        $_patten = '/\{\$([\w]+)\}/';
        if(preg_match($_patten, $this->_tpl)){
            $this->_tpl = preg_replace($_patten, "<?php echo \$this->_vars['$1'];?>", $this->_tpl);
        }
    }

    // 解析 if 语句
    private function parIf(){
        $_pattenIf = '/\{if\s+\$([\w]+)\}/';
        $_pattenEndIf = '/\{\/if\}/';
        $_pattenElseIf = '/\{elseif\s+\$([\w]+)\}/';
        $_pattenElse = '/\{else\}/';

        // 判断是否存在 if 条件的开始标记 "{if xxx}"
        if(preg_match($_pattenIf, $this->_tpl)){
            // 如果存在 if 开始标记，则必须检查 if 的结束标记
            if(preg_match($_pattenEndIf, $this->_tpl)){
                // 如果 if 结束标记存在，则替换 if 开始和技术标签
                $this->_tpl = preg_replace($_pattenIf, "<?php if (\$this->_vars['$1']) { ?>", $this->_tpl);
                $this->_tpl = preg_replace($_pattenEndIf, "<?php } ?>", $this->_tpl);

                // 如果存在 elseif 标签，则替换
                if(preg_match($_pattenElseIf, $this->_tpl)){
                    $this->_tpl = preg_replace($_pattenElseIf, "<?php } elseif (\$this->_vars['$1']) { ?>", $this->_tpl);
                }

                // 如果存在 else 标签，则替换
                if(preg_match($_pattenElse, $this->_tpl)){
                    $this->_tpl = preg_replace($_pattenElse, "<?php } else { ?>", $this->_tpl);
                }
            } else {
                exit('ERROR: if 标签没有关闭！');
            }
        }
    }

    private function parForeach(){
        /* foreach 格式
         * {foreach $array(key, value)}
         *      {@key} ... {@value}
         * {/foreach}
         * */
        $_pattenForeach = '/\{foreach\s+\$([\w]+)\(([\w]+),\s*([\w]+)\)\}/';
        $_pattenEndForeach = '/\{\/foreach\}/';
        $_pattenVar = '/\{@([\w]+)([\w\-\>]*)\}/';

        // 判断 foreach 开始标签是否存在
        if(preg_match($_pattenForeach, $this->_tpl)){
            // 判断 foreach 结束标签是否存在
            if(preg_match($_pattenEndForeach, $this->_tpl)){
                // 替换 foreach 开始标签
                $this->_tpl = preg_replace($_pattenForeach, "<?php foreach (\$this->_vars['$1'] as \$$2 => \$$3) { ?>", $this->_tpl);
                // 替换 foreach 结束标签
                $this->_tpl = preg_replace($_pattenEndForeach, "<?php } ?>", $this->_tpl);

                // 判断循环变量是否存在
                if(preg_match($_pattenVar, $this->_tpl)){
                    $this->_tpl = preg_replace($_pattenVar, "<?php echo \$$1$2; ?>", $this->_tpl);
                }
            } else {
                exit('ERROR: foreach 结束标签不存在！');
            }
        }
    }

    // 解析 include
    private function parInclude(){
        $_patten = '/\{include\s+file=(\"|\')([\w\.\-\/]+)(\"|\')\}/';

        // 判断是否存在 include 标签
        if(preg_match($_patten, $this->_tpl, $_files)){
            // 判断引用的文件是否存在
            if( ! file_exists($_files[2]) || empty($_files)) {
                exit('ERROR: 包含文件出错！');
            }

            // 文件检测通过，替换 include 标签
            $this->_tpl = preg_replace($_patten, "<?php include '$2'; ?>", $this->_tpl);
        }
    }

    // 解析系统变量
    private function parConfig(){
        $_patten = '/<!--\s*\{([\w]+)\}\s*-->/';

        // 判断系统变量标签是否存在
        if (preg_match($_patten, $this->_tpl)) {
            $this->_tpl = preg_replace($_patten, "<?php echo \$this->_config['$1']; ?>", $this->_tpl);
        }
    }

    // 解析PHP代码注释
    private function parCommon(){
        $_patten = '/\{#\}(.*)\{#\}/';
        if (preg_match($_patten, $this->_tpl)) {
            $this->_tpl = preg_replace($_patten, "<?php /* $1 */ ?>", $this->_tpl);
        }
    }

    // 对外公共方法
    public function compile($_parFile){
        // 解析模版内容
        $this->parVar();
        $this->parIf();
        $this->parForeach();
        $this->parInclude();
        $this->parConfig();
        $this->parCommon();

        // 生成编译文件
        if( ! file_put_contents($_parFile, $this->_tpl)){
            exit('ERROR: 编译文件生成错误！');
        }
    }
}