<?php
interface UF
{
    //是否连接件
    public function isConnected($p , $q);
    public function unionElements($p , $q);
    public function getSize();

}
