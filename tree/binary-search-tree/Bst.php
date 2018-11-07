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
            $this->__add($this->root,$e);
        }
    }
    //向以Node为根的树中插入元素e
    //递归操作
    private function __add(?Node $node , $e):void
    {
        //如果待插入的元素和节点相等，则直接返回
        if($e == $node->e)
        {
            return;
        //若元素小于节点，且左节点为空，则插入左节点
        }else if($e < $node->e && $node->left == null)
        {
            $node->left = new Node($e);
            $this->size ++;
            return;
        }else if($e > $node->e && $node->right == null)
        {
            $node->right = new Node($e);
            $this->size ++;
            return;
        }
        //递归
        if($e < $node->e)
        {
            $this->__add($node->left,$e);
        }else
        {
            $this->__add($node->right,$e);
        }

    }
    //递归查找
    public function contains($e):bool
    {
        return $this->__contains($this->root,$e);

    }
    private function __contains(?Node $node ,$e):bool
    {
        if($node == null)
        {
            return false;
        }
        if($e == $node->e)
        {
            return true;
        }else if($e < $node->e)
        {
            $this->__contains($node->left,$e);
        }else
        {
            return $this->__contains($node->right,$e);
        }
    }
    //前序遍历
    public function preOrder():void
    {
        $this->__preOrder($this->root);
    }
    private function __preOrder(?Node $node):void
    {
        if($node == null)
        {
            return;
        }
        var_dump($node->e);
        $this->__preOrder($node->left);
        $this->__preOrder($node->right);
    }
    //层序遍历 基于队列o
    public function levelOrder():void
    {
        $queue = [];
        //入队
        array_push($queue,$this->root);
        while(!empty($queue))
        {
            //出队
            $cur = array_shift($queue);
            var_dump($cur->e);
            if($cur->left != null)
            {
                array_push($queue,$cur->left);
            }
            if($cur->right != null)
            {
                array_push($queue,$cur->right);
            }
        }
    }
    //返回最小最大的树
    public function mini()
    {
        if($this->size == 0)
        {
            throw new Exception("Bst is empty");
        }
        return $this->__mini($this->root)->e;
    }
    private function __mini(Node $node)
    {
        if($node->left == null)
        {
            return $node;
        }
        return $this->__mini($node->left);
    }
    public function max()
    {
        if($this->size == 0)
        {
            throw new Exception("Bst is empty");
        }
        return $this->__max($this->root)->e;
    }
    private function __max(Node $node)
    {
        if($node->right == null)
        {
            return $node;
        }
        return $this->__max($node->right);
    }
    //删除最大值
    public function removeMin()
    {
        $ret = $this->mini();
        $this->root = $this->__removeMin($this->root);
        return $ret;
    }
    private function __removeMin(Node $node)
    {
        if($node->left == null)
        {
            $rightNode = $node->right;
            $node->right = null;
            $this->size --;
            return $rightNode;
        }
        $node->left = $this->__removeMin($node->left);
        return $node;
    }
    public function removeMax()
    {
        $ret = $this->max();
        $this->root = $this->__removeMax($this->root);
        return $ret;
    }
    private function __removeMax(Node $node)
    {
        if($node->right == null)
        {
            $leftNode = $node->left;
            $node->left = null;
            $this->size --;
            return $leftNode;
        }
        $node->right = $this->__removeMax($node->right);
        return $node;
    }
    public function remove($e):void
    {
        $this->root = $this->__remove($this->root , $e);
    }
    private function __remove(Node $node ,$e):Node
    {
        if($node == null)
            return null;
        if($e < $node->e)
        {
            $node->left = $this->__remove($node->left ,$e);
            return $node;
        }else if($e > $node->e)
        {
            $node->right = $this->__remove($node->right ,$e);
            return $node;
        }else
        {
            if($node->left == null)
            {
                $rightNode = $node->right;
                $node->right = null;
                $this->size --;
                return $rightNode;
            }
            if($node->right == null)
            {
                $leftNode = $node->right;
                $node->left = null;
                $this->size --;
                return $leftNode;
            }
            //左右子树都不为空
            $successor = $this->__mini($node->right);
            $successor->right = $this->__removeMin($node->right);
            $successor->left = $node->left;
            $node->left = null;
            $node->right = null;
            return $successor;
        }
    }

}

