<?php
require_once "./AvlTree.php";
use avl\AvlTree;
$map = new AvlTree();
//$node = new \map\Node("sfsd","sdfsd");
$a = ['a','b','c','d','e','f','g','h'];
foreach($a as $key => $value)
{
    $map->add($value,1);
}
$map->preOrder();
echo "\n\n\n\n";
$a = ['a','b','c','d','e','f'];
foreach($a as $value)
{
    $map->remove($value);
}
$map->preOrder();

//print_r($map->isBalanced());
//$map->preOrder();
//var_dump($map->get(99));

//$map->keySet();
