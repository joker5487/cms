<?php

/**
 * Created by PhpStorm.
 * User: monstar
 * Date: 2018/12/6
 * Time: 下午5:01
 */

// 内容实体类
class ContentModel extends Model
{
    private $id;
    private $title;
    private $nav;
    private $attr;
    private $tag;
    private $keyword;
    private $thumbnail;
    private $info;
    private $source;
    private $author;
    private $content;
    private $commend;
    private $count;
    private $gold;
    private $color;
    private $limit;

    // 拦截器（__set）
    public function __set($_key, $_value)
    {
        $this->$_key = Tool::mysqlString($_value);
    }

    // 拦截器（__get）
    public function __get($_key)
    {
        return $this->$_key;
    }

    // 新增
    public function addContent() {
        $_sql = "INSERT INTO
                            cms_content (
                                title,
                                nav,
                                attr,
                                tag,
                                keyword,
                                thumbnail,
                                info,
                                source,
                                author,
                                content,
                                commend,
                                count,
                                gold,
                                color,
                                date
                            ) VALUES (
                                '$this->title',
                                '$this->nav',
                                '$this->attr',
                                '$this->tag',
                                '$this->keyword',
                                '$this->thumbnail',
                                '$this->info',
                                '$this->source',
                                '$this->author',
                                '$this->content',
                                '$this->commend',
                                '$this->count',
                                '$this->gold',
                                '$this->color',
                                NOW()
                            )";

        return parent::aud($_sql);
    }

    // 获取文档列表
    public function getListContent() {
        $_sql = "
            SELECT
                  c.id,
                  c.title,
                  c.date,
                  c.info,
                  c.thumbnail,
                  c.count,
                  n.nav_name
            FROM cms_content c, cms_nav n
            WHERE c.nav = n.id AND c.nav IN ($this->nav)
            ORDER BY c.date DESC
            $this->limit
        ";

        return parent::all($_sql);
    }

    // 获取主类下的子类的Id
    public function getNavChildId() {
        $_sql = "
            SELECT
                id
            FROM cms_nav
            WHERE pid = '$this->id'
        ";

        return parent::all($_sql);
    }

    // 获取文档总记录
    public function getListContentTotal() {
        $_sql = "
            SELECT count(id)
            FROM cms_content
            WHERE nav IN ($this->nav)
        ";

        return parent::total($_sql);
    }

    // 获取单一文档的详细内容
    public function getOneContent() {
        $_sql = "
            SELECT
                id,
                title,
                nav,
                content,
                info,
                date,
                count,
                author,
                source
            FROM cms_content
            WHERE id = '$this->id'
            LIMIT 1
        ";

        return parent::one($_sql);
    }
}