<?php
require_once "./Merger.php";

class Addmerger implements Merger
{
    public function merge($a , $b)
    {
        return  $a."-".$b;
    }
}
