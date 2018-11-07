<?php
namespace trie;
require_once "../bst_map/BstMap.php";
use map\BstMap;
class Node
{
    public $isWord;//boolean

    public $next;//bstmap

    public function __construct($isWord = false)
    {
        $this->isWord = $isWord;
        $this->next = new BstMap();
    }
}

class Trie
{
    public $root ;//node;
    private $size;
    //初始化
    public function __construct()
    {
        $this->root = new \trie\Node();
        $this->size = 0;
    }

    public function getSize():int
    {
        return $this->size;
    }
    //添加字符
    public function add(string $word):void
    {
        $cur = $this->root;
        for($i = 0 ; $i < strlen($word) ; $i ++)
        {
            $c = $word[$i];
            if($cur->next->get($c) == null)
                $cur->next->add($c , new \trie\Node());
            $cur = $cur->next->get($c);
        }
        if(!$cur->isWord)//最后一个节点
        {
            $cur->isWord = true;
            $this->size ++;
        }
        print_r($this->root);
    }
    //查找是否存在
    public function contains(string $word):bool
    {
        $cur = $this->root;
        for($i = 0 ; $i < strlen($word) ; $i ++)
        {
            $c = $word[$i];
            if($cur->next->get($c) == null)
                return false;
            $cur = $cur->next->get($c);
        }
        return $cur->isWord;
    }
    //前缀搜索
    public function isPrefix(string $prefix):bool
    {
        $cur = $this->root;
        for($i = 0 ; $i < strlen($prefix) ; $i ++)
        {
            $c = $prefix[$i];
            $word = $cur->next->get($c);
            if($word == null)
                return false;
            $cur = $word;
        }
        return true;
    }
    public function search($word)
    {
        return $this->match($this->root , $word,$index);
    }
    public function match($node , $word , $index)
    {
        if($index == strlen($word))
            return $node->isWord;
        $c = $word[$index];
        if($c != '.')
        {
            if($node->next->get($c) == null)
            {
                return false;
            }
            return $this->match($node->next->get($c) , $word,$index + 1);
        }else
        {
            for()
        }


    }


}
