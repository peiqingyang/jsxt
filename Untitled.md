# php+html竞赛系统

---

## 1.介绍

通过提交ip 用户名 密码

后台执行数据库写好的bash命令`commd`，获取返回值，进行判断，返回内容是否包含数据库里的答案`pass`,进行计分，页面显示当前题目，分数。

截图：

![登录界面.png](https://github.com/peiqingyang/cloud-study/blob/master/%E7%99%BB%E5%BD%95%E7%95%8C%E9%9D%A2.png?raw=true)

![登录失败.png](https://github.com/peiqingyang/cloud-study/blob/master/%E7%99%BB%E5%BD%95%E5%A4%B1%E8%B4%A5.png?raw=true)

![1.png](https://github.com/peiqingyang/cloud-study/blob/master/1.png?raw=true)

![2.png](https://github.com/peiqingyang/cloud-study/blob/master/2.png?raw=true)

![答题结束.png](https://github.com/peiqingyang/cloud-study/blob/master/%E7%AD%94%E9%A2%98%E7%BB%93%E6%9D%9F.png?raw=true)





## 2.部署环境需要创建数据库

用户名:`jsxt`

密码：`password`

数据库名称:`jsxt`

## 3.创建3张表

### users

| username | password |
| -------- | -------- |
| 用户名   | 密码     |
| test     | test     |
|          |          |

### requests

| requests  | id     | commd                   | pass                         | fenshu   |
| --------- | ------ | ----------------------- | ---------------------------- | -------- |
| 题目内容  | 题目id | 通过php ssh_2执行的命令 | 执行后返回内容需要包含的内容 | 该题分数 |
| 配置网络  | 1      | ip a                    | 127.0.0.1                    | 1        |
| 配置网络2 | 2      | ip a                    | 127.0.0.1                    | 2        |

### fenshu

| user               | fenshu       | dqid       |
| ------------------ | ------------ | ---------- |
| //当前登陆用户name | //已获得分数 | 当前题目id |
|                    |              |            |
|                    |              |            |