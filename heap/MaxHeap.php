<?php
class MaxHeap
{
    private $data;
    private $size;

    public function __construct()
    {
        $this->data = array();
        $this->size = 0;
    }
    public function size():int
    {
        return $this->size;
    }
    public function isEmpty():bool
    {
        return $this->size == 0;
    }

    private function parent(int $index):int
    {
        if($index == 0)
        {
            throw new Exception("o doesn't have parent");
        }
        return ($index-1)/2;
    }

    private function leftChild(int $index):int
    {
        return $index*2 + 1;
    }

    private function rightChild(int $index):int
    {
        return $index*2 + 2;
    }

    public function add($e):void
    {
        $this->data[] = $e;
        $this->siftUp($this->size - 1);
        $this->size ++;
    }
    private function siftUp(int $k):void
    {
        //当索引不等于0 则继续判断 当父亲节点大于当前节点则继续判断
        while($k > 0 && $this->data[$this->parent($k)] < $this->data[$k])
        {
            $this->swap($k ,$this->parent($k));
            $k = $this->parent($k);
        }
    }
    //交换位置
    public function swap(int $i , int $j)
    {
            $size = $this->size;
            if($i < 0 || $j >= $size || $j < 0 || $j >= $size)
                throw new Exception("index is illegal");
            $t = $this->data[$i];
            $this->data[$i] = $this->data[$j];
            $this->data[$j] = $t;

    }

    public function findMax()
    {
        if($this->size == 0)
            throw new Exception("heap is empty");
        return $this->data[0];
    }
    public function extractMax()
    {
        $ret = $this->findMax();
        $this->swap(0,$this->size-1);
        array_pop($this->data);
        $this->siftDown(0);
    }
    private function siftDown(int $k):void
    {
        while($this->leftChild($k) < $this->size)
        {
                $j  = $this->leftChild($k);
                if($j+1 < $this->size && $this->data[$j+1] >$this->data[$j])
                {
                    $j = $this->rightChild($k);
                }
                if($this->data[$k] >= $this->data[$j])
                {
                    break;
                }
                $this->swap($k,$j);
                $k = $j;
        }
    }
    //取出最大的数在替换一个新的数
    public function replace($e)
    {
        $ret = findMax();
        $this->data[0] = $e;
        $this->siftDown(0);
        return $ret;
    }
    //将array 转换成堆
    public function heapify(Array $arr)
    {
        $this->data = $arr;
        $this->size = count($arr);
        for($i = $this->parent($this->size -1) ; $i >= 0; $i --)
            $this->siftDown($i);
    }
    public function toString()
    {
        var_dump($this->data);
    }



}


