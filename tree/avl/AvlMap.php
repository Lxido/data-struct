<?php
require_once "./AvlTree.php";
use avl\AvlTree;
class AvlMap
{
    private $avl;//avl

    public function __construct()
    {
        $this->avl = new AvlTree();
    }
    public function getSize():int
    {
        return $this->size->getSize();
    }
    public function isEmpty():bool
    {
        return $this->avl->isEmpty();
    }
    public function add($key ,$value)
    {
        $this->avl->add($key,$value);
    }
    public function contains($key)
    {
        return $this->avl->contains();
    }
    public function get($k)
    {
        return $this->get($k);
    }
}
