### 说明

#### 用途

主要借助sqlmapapi和mitmproxy自动完成sql注入的测试，测试的过程极其简单，我们只要在我们的浏览器上配置好我们搭建的代理地址，然后随意的访问我们需要测试的地址即可，mitmproxy会自动将收到的请求（各种参数以及cookie的信息）转发到sqlmapapi进行注入测试。**用于学习目的，请勿用于攻击。**

#### 如何使用

 - 保证python版本大于2.7
 - 大致需要安装以下包
	```
     yum install python-devel libffi-devel libxml2 libxslt-devel libxml2-devel
    
    pip2.7 install netlib pyopenssl pyasn1 urwid lxml flask
    pip2.7 install pil --allow-external PIL --allow-unverified PIL
    pip2.7 install pyamf protobuf
    pip2.7 install nose pathod countershape
    pip2.7 install mitmproxy
    ```
 - 下载sqlmap <https://github.com/sqlmapproject/sqlmap>，启动sqlmapapi

 ```
 python sqlmapapi.py -s -H 0.0.0.0
 ```
 
 - 这个时候把输出的admin token填写到代码中的config.ini中
 - 启动mitmproxy
 
 ```
 mitmproxy -s mitmproxy.py
 ```


### 查看结果

只需要在当前目录下执行即可

```
php get_result.php
```
