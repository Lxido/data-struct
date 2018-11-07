<?php
include "./BstSet.php";
function main()
{
    $file = './english.txt';
    $handler = fopen($file,'r');
    $bstSet = new BstSet();
    $startTime = time();
    while($txt = fgets($handler))
    {
         $bstSet->add($txt);
    }

    echo time()-$startTime;
    var_dump($bstSet->getSize());
    fclose($handler);


}
main();
