<?php
require_once "./BstMap.php";
use map\BstMap;
$map = new BstMap();
$node = new \map\Node("sfsd","sdfsd");
foreach(range(1,100) as $key => $value)
{
    $map->add($key , $node);
}
/**
$map->preOrder();
var_dump($map->get(99));
**/

$map->keySet();
