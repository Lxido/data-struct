<?php
require_once "./AvlTree.php";
use avl\AvlTree;
$map = new AvlTree();
//$node = new \map\Node("sfsd","sdfsd");
$a = ['asdf','sfdsah','word','this','is','in','sdfs','sdfsd'];
foreach($a as $key => $value)
{
    $map->add($value,1);
}
print_r($map->isBalanced());
/**
$map->preOrder();
var_dump($map->get(99));
**/

//$map->keySet();
