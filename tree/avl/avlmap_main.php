<?php
require_once "./AvlMap.php";
use avl\Node;
$map = new AvlMap();
$node = new \avl\Node("sfsd","sdfsd");
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

