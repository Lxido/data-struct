<?php
require "./Queue.php";
require "../heap/MaxHeap.php";

class PriorityQueue implements Queue
{
    private $maxHeap;

    public function __construct()
    {
        $this->maxHeap = new MaxHeap();
    }
    public function getSize():int
    {
        return $this->maxHeap->size;
    }
    public function isEmpty():bool
    {
        return $this->maxHeap->size == 0;
    }
    public function getFront()
    {
        return $this->maxHeap->findMax();
    }
    public function enqueue($e):void
    {
        $this->maxHeap->add($e);

    }
    public function dequeue()
    {
        return $this->maxHeap->extractMax();
    }

}
