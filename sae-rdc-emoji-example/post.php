<?php
/**
 * Created by PhpStorm.
 * User: 37708
 * Date: 2019/1/12
 * Time: 19:26
 */
$instance = new SaeMysql();
$instance->setCharset('utf8mb4');

$instance->runSql('set names utf8mb4');

$data = $_POST['data'];
$data = $instance->escape($data);
if (!$data) {
    header('Location: index.php');
    exit();
}

$sql = sprintf("INSERT INTO `test`(content)VALUES('%s')", $data);

$ret = $instance->runSql($sql);

if (!$data) {
    header('Location: index.php');
    exit();
}