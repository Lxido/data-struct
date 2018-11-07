<?php
class Node
{
    public $e;
    public $left;//Node
    public $right;//Node

    public function __construct($e)
    {
        $this->e = $e;
        $this->left = null;
        $this->right = null;
    }

}

