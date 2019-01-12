<?php
/**
 * Created by PhpStorm.
 * User: 37708
 * Date: 2019/1/12
 * Time: 19:14
 */
$instance = new SaeMysql();
$instance->setCharset('utf8mb4');

$instance->runSql('set names utf8mb4');

$sql = "SELECT * FROM `test`";
$data = $instance->getData($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>展示数据</title>
</head>
<body>
<div id="add_data">
    <form action="post.php" method="post">
        <input type="text" name="data">
        <input type="submit" name="" value="提交">
    </form>
</div>
<div id="data_insert">
    <h4>已添加的数据</h4>
<?php if ($data):?>
    <ul>
<?php foreach ($data as $d):?>
        <li><?=$d['content']?></li>
<?php endforeach;?>
    </ul>
<?php endif;?>
</div>
</body>
</html>
