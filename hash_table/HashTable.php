<?php
require_once "AvlMap.php";

class HashTable
{
    private $hashtable;//array
    private $M;
    private $size;

    public function __construct(int $M = 97)
    {
        $this->M = $M;
        $this->size = 0;
        $this->hashtable = [];
        for($i = 0; $i < $this->M ; $i ++)
            $this->hashtable[$i] = new AvlMap();
    }

    public function hash($key)
    {
        /**
        if(empty($key))
            return 0;
        $mdv = md5($key);
        $mdv1 = substr($mdv,0,16);
        $mdv2 = substr($mdv,16,16);
        $crc1 = abs(crc32($mdv1));
        $crc2 = abs(crc32($mdv2));
        $code = bcmul($crc1,$crc2);
        **/
        $h = 0;
        $len = strlen($key);
        for($i = 0;$i < $len ;$i ++)
            $h = $this->overflow32(31*$h + ord($key[$i]));
        return ($h & 0x7fffffff)%$this->M;
    }
    public function overflow32($v)
    {
        $v = $v%4294967296;
        if($v >2147483647)return $v - 4294967296;
        elseif($v < -2147483647) return $v + 4294967296;
        else return $v;
    }
    public function getSize()
    {
        return $this->size;
    }
    public function add($key , $value)
    {
        $map = $this->hashtable[$this->hash($key)];
        if($map->contains($key))
            $map->add($key,$value);
        else
        {
            $map->add($key,$value);
            $this->size++;
        }
    }
    public function remove($key)
    {
        $map = $this->hashtable[$this->hash($key)];
        $ret = null;
        if($map->contains($key))
        {
            $ret = $map->remove($key);
        }
        return $ret;
    }

    public function set($key ,$value)
    {
        $map = $this->hashtable[$this->hash($key)];
        if($map->contains($key))
            throw new Exception("doesnt exist");
        $map->add($key,$value);
    }

    public function contains($key)
    {
        return $this->hashtable[$this->hash($key)]->contains($key);
    }
    public function get($key)
    {
        $this->hashtable[$this->has($key)]->get($key);
    }

}
