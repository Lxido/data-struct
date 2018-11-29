<?php
require_once './UF.php';

class UnionFind implements UF
{

    private $id;//int[]

    public function __construct($size)
    {
        for($i = 0 ; $i<$size ; $i++)
            $this->id[] = $i;
    }

    public function getSize()
    {
        return count($this->id);
    }

    private function find($p)
    {
        if($p <0 || $p >= count($this->id))
        {
            throw new Exception("sdf");
        }
        return $this->id[$p];
    }
    public function isConnected($p , $q)
    {
        return $this->find($p) == $this->find($q);
    }

    public function unionElements($p,$q)
    {
        $pid = $this->find($p);
        $qid = $this->find($q);

        if($pid == $qid)
            return;
        for($i = 0 ; $i < count($this->id); $i ++)
        {
            if($this->id[$i] == $pid)
                $this->id[$i] = $qid;
        }
    }

}
