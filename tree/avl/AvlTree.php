<?php
namespace avl;
class Node
{
    public $key;
    public $value;
    public $left;//Node
    public $right;//Node
    public $height;//记录每个节点的高度

    public function __construct($key , $value)
    {
        $this->key = $key;
        $this->value = $value;
        $this->left = null;
        $this->right = null;
        $this->height = 1;
    }

}

class AvlTree
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
    public function getHeight($node)
    {
        if($node == null)
            return 0;
        return $node->height;
    }
    public function isEmpty():bool
    {
        return $this->size == 0;
    }
    public function isBst():bool
    {
        $keys = [];
        $this->inOrder($this->root , $keys);
        for($i = 1 ;$i < count($keys);$i ++)
            if($keys[$i-1] > $keys[$i])
                return false;
        return true;
    }
    private function inOrder($node , &$keys)
    {
        if($node == null)
            return;
        $this->inOrder($node->left , $keys);
        $keys[] = $node->key;
        $this->inOrder($node->right,$keys);
    }
    public function isBalanced()
    {
        return $this->_isBalanced($this->root);
    }
    private function _isBalanced($node)
    {
        if($node == null)
            return true;
        $balanceFactor = $this->getBalanceFactor($node);
        if(abs($balanceFactor) > 1)
            return false;
        return $this->_isBalanced($node->left) && $this->_isBalanced($node->right);
    }
    //add
    public function add($key , $value):void
    {
        $this->root = $this->__add($this->root , $key , $value);
    }
    //右旋转
    //对接点y进行向右旋转的操作 ，返回旋转后新的根节点x
    //      y                                   x
    //     / \                                /   \
    //    x   T4     向右旋转(y)             z     y
    //   / \        -------------->         / \   / \
    //  z   T3                             T1 T2 T3 T4
    // /     \
    //T1     T2
    private function rightRotate($y)
    {
        $x = $y->left;
        $t3 = $x->right;
        //向右旋转的过程
        $x->right = $y;
        $y->left = $t3;
        //更新height
        $y->height = max($this->getHeight($y->left),$this->getHeight($y->right)) + 1;
        $x->height = max($this->getHeight($x->left),$this->getHeight($x->right)) + 1;
        return $x;
    }
    private function leftRotate($y)
    {
        $x = $y->right;
        $t2 = $x->left;
        //向左旋转的过程
        $x->left = $y;
        $y->right = $t2;
        //更新height
        $y->height = max($this->getHeight($y->left),$this->getHeight($y->right)) + 1;
        $x->height = max($this->getHeight($x->left),$this->getHeight($x->right)) + 1;
        return $x;
    }
    //向以Node为根的树中插入元素key => $value    //向以Node为根的树中插入元素e
    //递归操作
    private function __add($node , $key ,$value)
    {
        if($node == null)
        {
            $this->size++;
            return (new \avl\Node($key , $value));
        }
        if($key < $node->key)
            $node->left = $this->__add($node->left , $key ,  $value);
        else if($key > $node->key)
            $node->right = $this->__add($node->right , $key ,  $value);
        else
            $node->value = $value;
        //更新高度
        $node->height = 1 + max($this->getHeight($node->left),$this->getHeight($node->right));
        //计算平衡因子
        $balanceFactor = $this->getBalanceFactor($node);
        //不平衡 左旋转 LL
        if($balanceFactor > 1 && $this->getBalanceFactor($node->left) >= 0 )
           return   $this->rightRotate($node);
        //不平衡 右旋转 RR
        if($balanceFactor < -1 && $this->getBalanceFactor($node->right) <=0 )
            return  $this->leftRotate($node);
        //不平衡 LR
        if($balanceFactor > 1 && $this->getBalanceFacto($node->left) <0 )
        {
            $node->left = $this->leftRotate($node->left);
            return  $this->rightRotate($node);
        }
        //不平衡 RL
        if($balanceFactor < -1 && $this->getBalanceFactor($node->right) > 0 )
        {
            $node->right = $this->rightRotate($node->right);
            return $this->leftRotate($node);
        }
        return $node;
    }
    private function getBalanceFactor(?\avl\Node $node)
    {
        if($node == null)
            return 0;
        return $this->getHeight($node->left)-$this->getHeight($node->right);
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
