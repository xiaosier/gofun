#encoding:utf-8

from libmproxy.script import concurrent
import os

@concurrent
def request(context, flow):
    #url
    url = flow.request.scheme+'://'+flow.request.host+flow.request.path
    method = flow.request.method 
    post_data = flow.request.content
    if 'Referer' in flow.request.headers:
        refer = flow.request.headers['Referer'][0]
    else:
        refer = ''
    
    if 'cookie' in flow.request.headers:
        cookie = flow.request.headers['cookie'][0]
    else:
        cookie = ''

    if 'User-Agent' in flow.request.headers:
        ua = flow.request.headers['User-Agent'][0]
    else:
        ua = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0'
    print url
    print method
    print post_data
    print refer 
    print cookie 
    print ua
    # 调用php脚本插入sqlmap检测任务
    script = "php /root/lazy-auto-sql-inject-test/add_sqlmap_task.php --url='%s' --method='%s' --refer='%s' --cookies='%s' --user_agent='%s' --post_data='%s'"\
              %(url, method, refer, cookie, ua, post_data)

    print script
    os.system(script)
