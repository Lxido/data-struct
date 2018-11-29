<?php
require_once "./UnionFind.php";
require_once "./UnionFindTree.php";
require_once "./UnionFindRank.php";
require_once "./UnionFindRank5.php";
require_once "./UnionFindRank6.php";
$m = 3000000;
$size = 3000000;
function testuf($uf , $m)
{
    $size = $uf->getSize();
$start = time();
for($i = 0 ;$i < $m ; $i ++)
{
    $a = rand(0,$size-1);
    $b = rand(0,$size-1);
    $uf->unionElements($a,$b);
}

for($i = 0 ;$i < $m ; $i ++)
{
    $a = rand(0,$size-1);
    $b = rand(0,$size-1);
    $uf->isConnected($a,$b);
}

$end = time() - $start;
var_dump($end);
}





    $uf2 = new UnionFindRank6($size);
    testuf($uf2,$m);

    $uf1 = new UnionFindRank5($size);
    testuf($uf1,$m);


