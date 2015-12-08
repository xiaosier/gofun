<?php 
/**
 * @version			$Id$
 * @create 			Mon 29 Jun 2015 02:44:23 PM CST By lazypeople
 * @package 		None
 * @subpackage 		None
 * @copyRight 		sinacloud
 * 
 */
$long_opt = array(
        'url:',//必选，注入的url
        'method::',//可选，注入的方式，GET OR POST
        'cookies::',//可选，注入的cookies
        'post_data::',//可选，注入的参数
        'user_agent::',//可选，ua 
        'refer::',//可选，refer
        'headers::',//可选，头部
        );
$all_opt = getopt(null, $long_opt);

$usage = function() use($argv) {
    // usage
    echo "Welcome to lazy auto sql inject tools\n";
    echo "Usage:\n";
    echo "php ".$argv[0]." --url=http://example.com [--method=GET] [--cookies=a] [--post_data='a=b'] [--user_agent=aa] [--refer=xxx] [--headers=yy]\n";
    exit(1);
};

if (!$all_opt['url']) {
    $usage();
}

define('ROOT', dirname(__FILE__));
require(ROOT.'/lib/sqlmap_client.class.php');
// load config file 
$config_file = ROOT.'/config.ini';
$all_config = parse_ini_file($config_file, true);
$sql_map_client = new SqlMapClient($all_config['SqlMapApi']['host'], $all_config['SqlMapApi']['port'], $all_config['SqlMapApi']['admin_token']);

$method = $all_opt['method'];
// method 
if (!$method) {
    $method = 'GET';
} elseif ($method == 'POST') {
} elseif ($method == 'GET') {
} else {
    $usage();
}
// 此时开始判断url是否含有查询的参数
// 如果不包含查询串的请求直接忽略，因为不会存在注入的漏洞
$parse_url_result = parse_url($all_opt['url']);
$exist_query_string = array_key_exists('query', $parse_url_result);

if ($method == 'POST' && !$all_opt['post_data'] && !$exist_query_string) {
    die('None param for detecting');
}

if ($method == 'GET' && !$exist_query_string)  {
    die('None param for detecting');
}

if ($method == 'GET') {
    $j_url = "http://eypp.changes.com.cn/home/mitmproxy/addtask?token=2b32a2bd311b9f8749d7bb289e6ae59b";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $j_url);
    $post_data_check = array('url' => $all_opt['url']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data_check);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $ret = curl_exec($ch);
    curl_close($ch);
    if ($ret) {
        $json = json_decode($ret, true);
        if ($json['code'] != 0) {
            die('checked before,exiting');
        }
    }
}
// 判断url结束

$new_task = $sql_map_client->new_task();
if ($new_task && $new_task['success']) {
    $task_id = $new_task['taskid'];
} else {
    die("Failed start a sqlmap session\n");
}

// set options
if ($method == 'GET') {
    $post_data = array('url' => $all_opt['url']);
} else {
    $post_data = array(
            'url' => $all_opt['url'],
            'data' => $all_opt['post_data'],
            );
}

if ($all_opt['cookies']) {
    $post_data['cookies'] = $all_opt['cookies'];
}

if ($all_opt['user_agent']) {
    $post_data['user-agent'] = $all_opt['user_agent'];
}

if ($all_opt['headers']) {
    $post_data['headers'] = $all_opt['headers'];
}

if ($all_opt['refer']) {
    $post_data['referer'] = $all_opt['refer'];
}

$ret = $sql_map_client->start_task($task_id, $post_data);
// 记录一下url和查询的task_id
$record = sprintf("Url:%s\tTask_id:%s\n", $all_opt['url'], $task_id);
file_put_contents(ROOT.'/record.txt', $record, FILE_APPEND);
var_dump($ret);
