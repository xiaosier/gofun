<?php
use sinacloud\sae\Storage as Storage;
$s = new Storage("ywjgmis:AK", 'SK');

$ret = $s->copyObject('ywjgmis', 'appUpdate/jgapp.apk', 'ywjgmis', 'appUpdate/jgapp.apk', array(), array('content-type' => 'application/vnd.android.package-archive'));
var_dump($ret);
