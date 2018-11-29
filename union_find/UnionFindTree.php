<?php

require_once "./UF.php";

class UnionFindTree implements UF
{
    private $parent;//array
    private $rank;//array

    public function __construct( $size)
    {
        for($i = 0; $i < $size;$i++)
        {
            $this->parent[$i] = $i;
            $this->rank[$i] = $i;
        }
    }
    public function getSize()
    {
        return count($this->parent);
    }
    private function find( $p)
    {
        if($p <0 || $p >= count($this->parent))
        {
            throw new Exception("length is illeagl");
        }
        while($p != $this->parent[$p])
        {
            $p = $this->parent[$p];
        }
        return $p;
    }

    public function isConnected( $p ,  $q)
    {
        return $this->find($p) == $this->find($q);
    }

    public function unionElements( $p,  $q)
    {
        $pid = $this->find($p);
        $qid = $this->find($q);

        if($pid == $qid)
            return;
        if($this->rank[$pid] < $this->rank[$qid])
        {
            $this->parent[$pid] = $qid;
        }else if($this->rank[$qid] <$this->rank[$pid])
        {
            $this->parent[$qid] = $pid;
        }else
        {
            $this->parent[$qid] = $pid;
            $this->rank[$pid] += 1;
        }
    }

}

