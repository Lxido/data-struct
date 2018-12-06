<?php
    function hashCode($key)
    {
        if(empty($key))
            return '';
        $mdv = md5($key);
        $mdv1 = substr($mdv,0,16);
        $mdv2 = substr($mdv,16,16);
        $crc1 = abs(crc32($mdv1));
        $crc2 = abs(crc32($mdv2));
        $code = bcmul($crc1,$crc2);
        return ($code & 0x7fffffff)%97;
    }

echo hashCode("key");

