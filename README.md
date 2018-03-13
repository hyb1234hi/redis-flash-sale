# redis-flash-sale
1.首先要安装redis扩展

2.建立3个队列
  一个库存队列(store)，一个用户队列（user），一个用户抢单结果集合(result)

3.测试过程
  a.php init_redis.php
    初始化库存队列
  b.开启linux的计划任务，每分钟执行 cron_redis.php
  c.用ab命令测试并发  ab -c 1000 -n 10000 http://xxx.com/redis_in_user.php
