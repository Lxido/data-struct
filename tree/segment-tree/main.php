<?php

require "./SegmentTree.php";
require "./Addmerger.php";

$nums = [-2,0,3,-5,2,-1];
$segTree = new SegmentTree($nums , new Addmerger());
$segTree->toString();
var_dump($segTree->query(0,4));
