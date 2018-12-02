<?php
require_once "./RBTree.php";
use rb\RBTree;
$map = new RBTree();
$node = new \rb\Node("sfsd","sdfsd");
$startTime = time();

foreach(range(1,1000000) as $key => $value)
{
    $map->add($key , $node);
}
echo time()-$startTime;
/**
$map->preOrder();
var_dump($map->get(99));
**/

