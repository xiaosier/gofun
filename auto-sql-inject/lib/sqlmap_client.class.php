  <?php 
/**
 * SqlMap 客户端脚本
 * @author lazypeople<hfutming@gmail.com>
 * @desc
 * 
 * @package 		None
 * @version			$Id$
 */
class SqlMapClient
{
    private $host;
    private $port;
    private $admin_token;

    public function __construct($host, $port, $admin_token = null)
    {
        $this->host = $host;
        $this->port = intval($port);
        if ($admin_token) {
            $this->admin_token = $admin_token;
        }
    }
    
    // 生成一个新的检测任务
    public function new_task()
    {
        $url = '/task/new';
        return $this->request($url);
    }
    
    // 设置sqlmap的参数
    public function set_option($task_id, $options)
    {
        $set_options = json_encode($options);
        $header['Content-Type'] = 'application/json';
        $url = sprintf('/option/%s/set', $task_id);
        $post_data = $set_options;
        return $this->request($url, $header, $post_data);
    }

    // 获取设置的option选项
    public function get_option($task_id, $option)
    {
        $url = sprintf('/option/%s/get', $task_id);
        $post_data = array('option' => $option);
        $post_data = json_encode($post_data);
        $header['Content-Type'] = 'application/json';
        return $this->request($url, $header, $post_data);
    }

    public function list_option($task_id)
    {
        $url = sprintf('/option/%s/list', $task_id);
        return $this->request($url);
    }
    
    // 启动任务
    // post
    public function start_task($task_id, $options = false)
    {
        if ($options && is_array($options)) {
            $post = json_encode($options);
            $header = array('Content-Type: application/json');
        } else {
            $header = false;
            $post = json_encode(array('a' => 'b'));
        }
        $url = sprintf('/scan/%s/start', $task_id);
        return $this->request($url, $header, $post);
    }
    
    // 暂停某个任务
    public function stop_task($task_id)
    {
        $url = sprintf('/scan/%s/stop', $task_id);
        return $this->request($url);
    }

    // 删除任务
    public function delete_task($task_id)
    {
        $url = sprintf('/task/%s/delete', $task_id);
        return $this->request($url);
    }

    // 杀死某个正在执行的任务
    public function kill_task($task_id)
    {
        $url = sprintf('/scan/%s/kill', $task_id);
        return $this->request($url);
    }

    // 获取某个任务的状态
    public function status_task($task_id)
    {
        $url = sprintf('/scan/%s/status', $task_id);
        return $this->request($url);
    }
    
    // 获取任务的日志
    public function log_task($task_id)
    {
        $url = sprintf('/scan/%s/log', $task_id);
        return $this->request($url);
    }

    // 获取一个任务的数据
    public function data_task($task_id)
    {
        $url = sprintf('/scan/%s/data', $task_id);
        return $this->request($url);
    }

    // admin list all task
    public function list_all_task()
    {
        if (!$this->admin_token) {
            return false;
        }
        $url = sprintf('/admin/%s/list', $this->admin_token);
        return $this->request($url);
    }

    // admin flush all task
    public function flush_all_task()
    {
        if (!$this->admin_token) {
            return false;
        }
        $url = sprintf('/admin/%s/flush', $this->admin_token);
        return $this->request($url);
    }
    
    // 生成请求的基本地址
    private function gener_request_url($url)
    {
        return 'http://'.$this->host.":".$this->port.$url;
    }

    private function request($url, $headers = false, $data = false)
    {
        $ch = curl_init();
        $url = $this->gener_request_url($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 12);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'LazyAutoScanSqlInject/1.0');
        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if ($data) {
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
        }
        $txt = curl_exec($ch);
        curl_close($ch);
        return json_decode($txt, true);
    }
}
