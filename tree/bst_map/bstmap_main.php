<?php
require_once "./BstMap.php";
use map\BstMap;
$map = new BstMap();
$node = new \map\Node("sfsd","sdfsd");
$startTime = time();

foreach(range(1,100) as $key => $value)
{
    $map->add($key , $node);
}
echo time()-$startTime;
/**
$map->preOrder();
var_dump($map->get(99));
**/

