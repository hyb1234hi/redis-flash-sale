<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/13 0013
 * Time: 11:29
 */
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
// 使用一个计划任务
// 1.写一个堵塞的程序
$rand = rand(0,1000);
$user = $redis->rPop('user',$rand);

$re = $redis->sIsMember('result',$user);
if($re){    // 已抢单过
//    echo '已经抢过单了';
}else{  // 还没有抢单
   $store = $redis->rPop('store');
    if($store){
        $redis->sAdd('result',$user);
        // 做数据库的操作
//        echo '抢单成功';
    }else{
        // 没有库存了
//        echo '没有库存了';
    }
}