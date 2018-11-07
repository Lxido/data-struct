<?php
require_once "./Merger.php";
class SegmentTree
{
    private $tree;//tree
    private $data;//array
    private $merger;//merger
    public function __construct(array $arr , Merger $merger)
    {
        $this->data = $arr;
        $this->tree = [];
        $this->merger= $merger;
        $this->buildSegmentTree(0,0,count($this->data)-1);
    }
    //数组转线段树(递归)
    private function buildSegmentTree(int $treeIndex , int $l , int $r):void
    {
        if( $l == $r )
        {
            $this->tree[$treeIndex] = $this->data[$l];
            return;
        }
        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);
        //$mid = ($l+$r)/2;当l 和r 特别大的时候容易溢出
        $mid = $l + ($r-$l)/2;
        $this->buildSegmentTree($leftTreeIndex , $l , $mid);
        $this->buildSegmentTree($rightTreeIndex , $mid+1 , $r);
        $this->tree[$treeIndex] = $this->merger->merge($this->tree[$leftTreeIndex] , $this->tree[$rightTreeIndex]);
    }
    //区间查询
    public function query(int $queryL , int $queryR)
    {
        if($queryL < 0 || $queryL > count($this->data) || $queryL > $queryR ||$queryR < 0 ||$queryR > count($this->data))
            throw new Exception("返回错误");
        return $this->__query(0 , 0 , count($this->data) - 1 , $queryL , $queryR);
    }
    //在以treeid 为根的线段树中[l...r]的范围里，搜索区间[queryl , queryR]的值
    private function __query(int $treeIndex , int $l, int $r, int $queryL , int $queryR)
    {
        if($l == $queryL && $r == $queryR)
            return $this->tree[$treeIndex];
        $mid = $l + ($r - $l)/2;
        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);
        if($queryL >= $mid +1)
            return $this->__query($rightTreeIndex,$mid+1 , $r,$queryL , $queryR);
        else if($queryR <= $mid)
            return $this->__query($leftTreeIndex,$l , $mid,$queryL , $queryR);
        $leftResult = $this->__query($leftTreeIndex , $l ,$mid ,$queryL , $mid);
        $rightResult = $this->__query($rightTreeIndex , $mid+1 ,$r ,$mid+1 , $queryR);
        return $this->merger->merge($leftResult ,$rightResult);
    }
    public function set(int $index ,$e):void
    {
        $this->data[$index] = $e;
        $this->__set(0,0,count($this->data)-1 , $index ,$e);
    }
    private function __set(int $treeIndex ,int $l,int $r,int $index , $e)
    {
        if($l == $r)
        {
            $this->tree[$treeIndex] = $e;
            return;
        }
        $mid = $l + ($r - $l)/2;
        $leftTreeIndex = $leftChild($treeIndex);
        $rightTreeIndex = $rightChild($treeIndex);
        if($index >= $mid + 1)
            $this->__set($rightTreeIndex , $mid + 1 , $r , $index  ,$e);
        else
            $this->__set($leftTreeIndex , $l , $mid, $index  ,$e);
        $this->tree[$treeIndex] = $this->merger->merger($this->tree[$leftTreeIndex],$this->tree[$rightTreeIndex]);


    }

    public function getSize():int
    {
        return count($this->data);
    }

    public function get(int $index)
    {
        if($index < 0 || $index >= count($this->data))
            throw new Exception("index is illegal");
        return $this->data[$index];
    }

    private function leftChild(int $index)
    {
        return 2*$index +1;
    }
    private function rightChild(int $index)
    {
        return 2*$index +2;
    }
    public function toString()
    {
        var_dump($this->data);
        echo "\n";
        var_dump($this->tree);
    }


}
