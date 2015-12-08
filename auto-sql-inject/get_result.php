<?php 
define('ROOT', dirname(__FILE__));
require(ROOT.'/lib/sqlmap_client.class.php');
$all_config = parse_ini_file(ROOT.'/config.ini', true);

$sql_map_client = new SqlMapClient($all_config['SqlMapApi']['host'], $all_config['SqlMapApi']['port'], $all_config['SqlMapApi']['admin_token']);

// 获取所有的id,扫描result
$record_file = ROOT.'/record.txt';
$all_line = explode("\n", file_get_contents($record_file));

foreach ($all_line as $line) {
    list($url, $id) = explode("\t", $line);
    if (strstr($url, 't.sinajs.cn')) {
        continue;
    }
    list($useless,$id) = explode(":", $id);
    $status = $sql_map_client->status_task($id);
    if ($status['status'] == 'terminated') {
        //已经结束的状态
        $data = $sql_map_client->data_task($id);
        if ($data['data']) {
            $str = sprintf("%s, taskid:%s is injectable!\n", $url, $id);
            echo $str;
        }
    }
}
