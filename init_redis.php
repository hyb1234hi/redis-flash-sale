<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/13 0013
 * Time: 10:58
 */
// 定时任务执行的文件
// 把库存写入到一个库存列表
$redis  = new Redis();
$redis->connect('127.0.0.1',6379);
$init_data = json_decode(file_get_contents('./init.json'));
//$init_data->store;// 库存量
for($i=0;$i<$init_data->store;$i++){
    $redis->rpush('store',$i);
}
echo $redis->llen('store');