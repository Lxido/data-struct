<?php

require_once "./UF.php";

class UnionFindRank5 implements UF
{
    private $parent;//array
    //基于rank
    private $rank;//array

    public function __construct( $size)
    {
        for($i = 0; $i < $size;$i++)
        {
            $this->parent[$i] = $i;
            $this->rank[$i] = 1;
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
            //路径压缩
            $this->parent[$p] = $this->parent[$this->parent[$p]];
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

