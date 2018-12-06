<?php
require_once "./HashTable.php";
$map = new HashTable(10);
$node = new \avl\Node("sfsd","sdfsd");
$startTime = time();

foreach(range(1,300000) as $key => $value)
{
    $map->add($key , $node);
}

foreach(range(1,300000) as $key => $value)
{
    $map->contains($key);
}
foreach(range(1,300000) as $key => $value)
{
    $map->remove($key);
}
echo time()-$startTime;

/**
$map->preOrder();
var_dump($map->get(99));
**/

