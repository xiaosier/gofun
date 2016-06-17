<?php
require('gapi.php');
use sinacloud\sae\Gapi;
header("Content-type:text/plain;charset=gbk");

$i = new Gapi(SAE_ACCESSKEY, SAE_SECRETKEY);
$ret = $i->get('/financehq/list=sh000001');
var_dump($ret);