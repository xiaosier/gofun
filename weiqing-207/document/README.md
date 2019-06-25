# 微擎在新浪云安装说明文档

## 安装前应该准备的列表

- 微擎账号，如果没有，从<https://s.w7.cc/register>完成注册
- 新浪云账号，如果没有，请从 <https://www.sinacloud.com/index/regguide.html> 完成注册
- 一个有备案的域名，如果没有，请先从 <http://www.xinnet.com/> 注册一个域名，然后从新浪云完成备案 <https://ba.sinacloud.com>

::: warning 关于域名问题
新浪云提供的二级域名仅用于测试，请不要用于微信环境，直接用在微信环境可能二级域名可能被微信封禁导致无法访问。
:::

## 从新浪云市场安装

### 安装地址

登录新浪云，完成实名认证后，从<https://market.sinacloud.com/#/dashbord/detail?id=153>创建微擎应用，安装时需要选择系统的配置、及应用的二级域名。

如下图所示：

<img :src="$withBase('/images/1.png')" alt="创建应用">

::: tip 关于二级域名
- 二级域名是应用的标识，您可以填写数字和英文小写字符的组合，4到32位，例如 ``lazypeople``, ``wasysss222``等等。
- 二级域名新浪云已经完成备案，但是您只有使用权，在应用续存期间可以免费使用，但是不建议用于生产环境。
:::

### 填写二级域名，点击安装

如下图所示：

<img :src="$withBase('/images/2.png')" alt="填写二级域名，点击安装">

### 等待安装完成

系统会自动安装应用，创建并开启挂链服务，如下图所示：

<img :src="$withBase('/images/3.png')" alt="等待安装完成">

### 安装完成

<img :src="$withBase('/images/4.png')" alt="安装完成后可以看到初始化页面">

::: warning 请稍等
此时不要着急进入安装，请先按以下说明的步骤绑定您的独立域名，用独立域名完成安装
:::

## 绑定独立域名

### 进入应用管理中心，绑定域名

前面的部分已经提到，注册微擎的站点时，不要使用新浪云提供的二级域名，因此在安装前，请**务必**先绑定您自己的独立域名，如果您没有独立域名，请先购买域名后从<https://ba.sinacloud.com>新浪云备案服务完成备案后再绑定。

进入云应用管理中心：<https://sae.sinacloud.com>，搜索刚创建应用的二级域名前缀，例如``weiqingexample``，可以看到应用：

<img :src="$withBase('/images/5.png')" alt="管理应用">

点击上面箭头标注的**管理**，进入应用的管理中心：

<img :src="$withBase('/images/6.png')" alt="应用管理中心">

选择左侧导航“应用设置”，点击“域名绑定”，进入域名绑定页面：

<img :src="$withBase('/images/7.png')" alt="进入域名绑定">

### 绑定您的独立域名

点击 **+新增域名绑定** ，输入您自己的域名：

::: warning 请主要
这里绑定的是您的独立域名，例如``weiqing.xxxxx.com``，不是新浪云提供的二级域名 ``xxxxx.applinzi.com``，这个二级域名默认已经绑定的不需要再次绑定。
:::

本例子，以 ``wq.changes.com.cn``我的独立域名为例绑定，您实际绑定的时候请换为您自己的域名！

输入域名，点击确认后，需要继续做解析才能完成绑定，点击“如何验证”按钮，系统会提示您如何添加解析：

<img :src="$withBase('/images/8.png')" alt="如何验证域名">

<img :src="$withBase('/images/9.png')" alt="如何验证域名">

### 在域名的DNS管理处按要求加域名解析

我的域名DNS是在``DNSPod``处管理的，登录dnspod系统增加域名解析，如果您的域名不再，请参考去对应的DNS厂商增加解析。

::: tip 域名解析说明
域名解析是DNS服务提供的功能，这个功能不是新浪云提供的，不是在新浪云完成！
:::

登录DNSPOD后，点击“添加记录”，按上面“如何验证”的提示增加域名解析：

<img :src="$withBase('/images/10.png')" alt="如何添加域名解析">

#### 添加CNAME解析

先按要求添加cname记录：

<img :src="$withBase('/images/11.png')" alt="加cname记录">

#### 添加A记录

按要求添加A记录：

<img :src="$withBase('/images/12.png')" alt="加A记录">

### 耐心等待域名绑定验证完成

增加解析后，可以等待新浪云自动完成域名验证，或者到系统点击【手工验证】，回到新浪云的域名绑定页面：

<img :src="$withBase('/images/13.png')" alt="点击手工认证">

### 域名绑定验证完成

如果你以上的域名解析都是对的，可以看到系统已经完成了验证：

<img :src="$withBase('/images/14.png')" alt="域名验证完成">

**现在终于可以进入真正的系统安装了。**

## 开始微擎安装

### 打开安装地址

在浏览器新标签打开访问地址： http://你的域名/install.php，以我绑定的为例：<http://wq.changes.com.cn/install.php>，打开后可以看到系统自动跳转到了微擎的登录地址，用你自己的微擎账号登录：

<img :src="$withBase('/images/15.png')" alt="微擎登录页面">

::: warning 如果没有微擎账号怎么办
请在自行在微擎官方注册账号，注册账号是不要钱的，注册地址 <https://s.w7.cc/register>
:::

### 输入微擎账号，勾选协议

<img :src="$withBase('/images/16.png')" alt="输入微擎账号">

输入信息，点击“验证后安装微擎”，系统会自动跳转到输入数据库信息页面。

<img :src="$withBase('/images/17.png')" alt="输入数据库信息页面">

### 填写数据库信息

不要惊慌，在新浪云安装微擎的时候已经自动帮你开启了共享MySQL服务，到系统就可以查到数据库的连接信息：

回到新浪云的应用管理面板，左侧导航选择“数据库与缓存服务”，选择“共享数据库”可以进入共享数据库页面：

<img :src="$withBase('/images/18.png')" alt="进入共享数据库页面">

按对应的信息填写：

::: warning 数据库主机
主机是``w.rdc.sae.sina.com.cn``，不是``127.0.0.1``
:::

<img :src="$withBase('/images/19.png')" alt="填写数据库信息">

### 点击安装系统

数据库信息填写完成后，点击“安装系统”：

<img :src="$withBase('/images/20.png')" alt="点击安装系统">

安装后，微擎会进入下载应用状态：

<img :src="$withBase('/images/21.png')" alt="下载代码">

耐心等待一会后下载完成，会进入安装完成页面，配置站点信息：

<img :src="$withBase('/images/22.png')" alt="配置信息">

配置完成后，点击“登录微擎系统”即可进入：


### 安装完成

到此系统已经安装完成：

<img :src="$withBase('/images/23.png')" alt="安装完成">

## 查看代码管理FTP信息

### 下载filezilla客户端

微擎安装在新浪云的容器环境，代码是通过本地存储挂载的，本地存储本身支持ftp管理，因此需要先下载ftp客户端：

进入 <https://filezilla-project.org/> filezilla官网，下载对应操作系统的ftp客户端，在本地安装即可，这个部分太简单了就是本地装一个软件，不再赘述。

### 查看ftp连接信息

登录新浪云本地存储管理中心：

<https://block.sinacloud.com>，找到刚刚创建的本地存储：

<img :src="$withBase('/images/24.png')" alt="本地存储列表">

点击管理，进入本地存储管理详情页面：

从存储概览页面即可查询到FTP的连接信息：

<img :src="$withBase('/images/25.png')" alt="FTP连接信息">

### ftp管理代码

输入FTP连接信息，点击快速登录即可看到远程的代码，使用FTP管理即可：

<img :src="$withBase('/images/26.png')" alt="FTP管理代码">

::: warning 请注意
如果你没有能力修改代码，请不要轻易修改系统代码。
:::

## 查看MySQL数据

### 使用phpmyadmin管理

新浪云提供的MySQL仅能在新浪云上使用，本地连接需要连接openVPN服务，这里不再赘述，如何使用请参考官方的文档：<https://www.sinacloud.com/doc/sae/php/cloudbridge.html>，通常phpmyadmin足以管理，新浪云提供phpmyadmin管理：

回到应用的管理中心<https://sae.sinacloud.com>，进到共享数据库的管理中心：

<img :src="$withBase('/images/27.png')" alt="phpmyadmin">

点击数据库管理中的推荐的phpmyadmin即可进入：

<img :src="$withBase('/images/28.png')" alt="phpmyadmin">

## 联系我

微博关注：<https://weibo.com/lazypeople>，有疑问私信会解答。