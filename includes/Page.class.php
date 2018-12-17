<?php
/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/12
 * Time: 上午10:25
 */
class Page {
    private $total;             // 总记录数
    private $pageSize;          // 每页显示的记录数
    private $limit;             // limit
    private $page;              // 当前页码
    private $pageNum;           // 总页码
    private $offset;            // 分页记录开始位置
    private $url;               // 当前访问地址
    private $bothNum;           // 当前页码两边保留的页码显示数

    // 构造函数初始化
    public function __construct($_total, $_pageSize) {
        $this->total = $_total ? $_total : 1;
        $this->pageSize = $_pageSize;
        $this->pageNum = ceil($this->total / $this->pageSize);
        $this->page = $this->setPage();
        $this->offset = ($this->page - 1) * $this->pageSize;
        $this->limit = ' LIMIT ' . $this->offset . ', ' . $this->pageSize;
        $this->url = $this->setUrl();
        $this->bothNum = 2;
    }

    // 拦截器
    public function __get($_key)
    {
        return $this->$_key;
    }

    // 获取访问地址
    private function setUrl() {
        $_url = $_SERVER['REQUEST_URI'];
        $_par = parse_url($_url);
        if (isset($_par['query'])) {
            parse_str($_par['query'], $_query);
            unset($_query['page']);
            $_url = $_par['path'] . '?' . http_build_query($_query);
        }

        return $_url;
    }

    // 数字分页
    private function pageList() {
        $_pageList = '';

        for ($i = $this->bothNum; $i >= 1; $i--) {
            $_page = $this->page - $i;
            if ($_page < 1) continue;
            $_pageList .= '<a href="' . $this->url . '&page=' . $_page . '">' . $_page . '</a>';
        }
        $_pageList .= '<span class="me">' . $this->page . '</span>';
        for ($i = 1; $i <= $this->bothNum; $i++) {
            $_page = $this->page + $i;
            if ($_page > $this->pageNum) break;
            $_pageList .= '<a href="' . $this->url . '&page=' . $_page . '">' . $_page . '</a>';
        }

        return $_pageList;
    }

    // 首页
    private function first() {
        if ($this->page > $this->bothNum + 1) {
            return ' <a href="' . $this->url . '">1</a> ... ';
        }
    }

    // 尾页
    private function last() {
        if ($this->page < $this->pageNum - $this->bothNum) {
            return ' ... <a href="' . $this->url . '&page=' . $this->pageNum . '">' . $this->pageNum . '</a> ';
        }
    }

    // 上一页
    private function prev() {
        if ($this->page == 1) {
            return '<span class="disabled">上一页</span>';
        }
        return ' <a href="' . $this->url . '&page=' . ($this->page - 1) . '">上一页</a> ';
    }

    // 下一页
    private function next() {
        if ($this->page == $this->pageNum) {
            return '<span class="disabled">下一页</span>';
        }
        $_currentPage = ($this->page + 1) > $this->pageNum ? $this->pageNum : ($this->page + 1);
        return ' <a href="' . $this->url . '&page=' . $_currentPage . '">下一页</a> ';
    }

    // 获取当前页码
    private function setPage() {
        $_currentPage = (! isset($_GET['page'])) || ($_GET['page'] < 1) ? 1 : $_GET['page'];
        $this->page = $_currentPage > $this->pageNum ? $this->pageNum : $_currentPage;

        return $this->page;
    }

    public function showPage() {
        if ($this->pageNum == 1) return '';

        $_page = '';
        $_page .= $this->first();
        $_page .= $this->pageList();
        $_page .= $this->last();
        $_page .= $this->prev();
        $_page .= $this->next();

        return $_page;
    }
}