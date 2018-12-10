<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/10
 * Time: 下午2:55
 */
class Action {
    protected $_tpl;
    protected $_model;

    protected function __construct(&$_tpl, &$_model) {
        $this->_tpl = $_tpl;
        $this->_model = $_model;
    }
}