<?php
include "./Bst.php";
include "./Set.php";

class BstSet implements Set
{
    private $bst;//Bst

    public function __construct()
    {
        $this->bst = new Bst();
    }

    public function getSize():int
    {
        return $this->bst->size();
    }

    public function isEmpty():bool
    {
        return $this->bst->isEmpty();
    }

    public function add($e):void
    {
        $this->bst->add($e);
    }

    public function remove($e):void
    {
        $this->bst->remove($e);
    }

    public function contains($e):bool
    {
        return $this->bst->contains($e);
    }

    public function getTree():Bst
    {
        return $this->bst;
    }

}
