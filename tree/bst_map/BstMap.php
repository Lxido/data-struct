<?php
namespace map;
class Node
{
    public $key;
    public $value;
    public $left;//Node
    public $right;//Node

    public function __construct($key , $value)
    {
        $this->key = $key;
        $this->value = $value;
        $this->left = null;
        $this->right = null;
    }

}

class BstMap
{
    private $root;//Node
    private $size;//int

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }
    public function getSize():int
    {
        return $this->size;
    }
    public function isEmpty():bool
    {
        return $this->size == 0;
    }
    //add
    public function add($key , $value):void
    {
        /**
         *
        //如果根为空，直接初始化
        if($this->root == null)
        {
            $this->root = new \map\Node($key , $value);
            $this->size ++;
        }else
        {
            $this->__add($this->root,$key , $value);
        }
        **/
        $this->root = $this->__add($this->root , $key , $value);
    }
    //向以Node为根的树中插入元素key => $value    //向以Node为根的树中插入元素e
    //递归操作
    private function __add(?Node $node , $key ,$value):\map\Node
    {
        /**
        //如果待插入的元素和节点相等，则直接返回
        if($key == $node->key)
        {
            $node->value = $value;
            return;
        //若元素小于节点，且左节点为空，则插入左节点
        }else if($key < $node->key && $node->left == null)
        {
            $node->left = new \map\Node($key , $value);
            $this->size ++;
            return;
        }else if($key > $node->key && $node->right == null)
        {
            $node->right = new \map\Node($key, $value);
            $this->size ++;
            return;
        }
        //递归
        if($key < $node->key)
        {
            $this->__add($node->left,$key,$value);
        }else
        {
            $this->__add($node->right,$key , $value);
        }
        **/
        if($node == null)
        {
            $this->size++;
            return (new \map\Node($key , $value));
        }
        if($key < $node->key)
            $node->left = $this->__add($node->left , $key ,  $value);
        else if($key > $node->key)
            $node->right = $this->__add($node->right , $key ,  $value);
        else
            $node->value = value;
        return $node;


    }
    //递归查找
    public function contains($key)
    {
        return $this->getNode($this->root,$key) != false;

    }
    private function getNode(?Node $node ,$key)
    {
        if($node == null)
        {
            return false;
        }
        if($key == $node->key)
        {
            return $node;
        }else if($key < $node->key)
        {
            return $this->getNode($node->left,$key);
        }else
        {
            return $this->getNode($node->right,$key);
        }
    }


    public function get($key)
    {
        $node = $this->getNode($this->root ,$key);
        return $node == false?false:$node->value;

    }
    public function set($key , $value):void
    {
        $node = $this->getNode($this->root,$key);
        if(!$node)
        {
            throw new Exception("doesn't exist");
        }
        $node->value = $value;
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
    public function remove($key)
    {
        $node = $this->getNode($this->root ,$key);
        if($node != null)
        {
            $node = $this->__remove($this->root ,$key);
            return $node->value;
        }
        return null;
    }
    private function __remove(Node $node ,$key):Node
    {
        if($node == null)
            return null;
        if($key < $node->key)
        {
            $node->left = $this->__remove($node->left ,$key);
            return $node;
        }else if($key > $node->key)
        {
            $node->right = $this->__remove($node->right ,$key);
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
    public function preOrder()
    {
        $this->__order($this->root);
    }
    public function __order(?Node $node)
    {
        if($node == null)
        {
            return;
        }
        echo $node->key."---";
        var_dump($node->value);
        $this->__order($node->left);
        $this->__order($node->right);

    }
    public function keySet()
    {
        return $this->__keySet($this->root,[]);
    }
    private function __keySet($node , $res)
    {
        if($node == null)
            return $res;
        $res[] = $node->key;
        $left = $this->__keySet($node->left, $res);
        $right = $this->__keySet($node->right, $res);
        return array_merge($left, $right);
    }


}
