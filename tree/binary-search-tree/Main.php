<?php
include "./Bst.php";
function main()
{
    $bst = new Bst();
    $array = [5,3,6,8,4,2];
    foreach($array as $v)
    {
        $bst->add($v);
    }
    print_r($bst);
    $bst->remove(5);
    echo "\n\n";
    print_r($bst);

}
main();
