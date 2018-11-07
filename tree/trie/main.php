<?php
require "Trie.php";
use trie\Trie;
$a = ['asdfas','asdfasf','safadsf','sadfasaf','public','main','void'];
$trie = new Trie();
foreach($a as $v)
{
    $trie->add($v);
}
var_dump($trie->search("a...s"));

