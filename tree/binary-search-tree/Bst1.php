<?php
include "./Node.php";
class Bst
{
    private $root;//Node
    private $size;
    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }
    //获取大小
    public function size():int
    {
        return $this->size;
    }
    //判断空
    public function isEmpty():bool
    {
        return $this->size == 0;
    }
    //add
    public function add($e):void
    {
        //如果根为空，直接初始化
        if($this->root == null)
        {
            $this->root = new Node($e);
            $this->size ++;
        }else
        {
            $this->root = $this->__add($this->root,$e);
        }
    }
    //向以Node为根的树中插入元素e
    //递归操作
    private function __add(?Node $node , $e):Node
    {
        if(node == null)
        {
            $this->size ++;
            return new Node(e);
        }
        //递归
        if($e < $node->e)
        {
            $node->left = __add($node->left,$e);
        }else if($e > $node->e)
        {
            $node->right = __add($node->right,$e);
        }
        return $node;

    }
}
