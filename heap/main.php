<?php
include "./MaxHeap.php";
$n = 1000000;
$maxHeap = new MaxHeap();
$arr = [];
for($i = 0 ;$i <$n ; $i++)
{
    $arr[] = rand(0,100000);
}
$starTime = time();
$maxHeap->heapify($arr);
echo time()-$starTime;
$test = new MaxHeap();
$starTime = time();
foreach($arr as $v)
{
    $test->add($v);
}
echo time()-$starTime;

