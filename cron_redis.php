<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/13 0013
 * Time: 11:29
 */
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
//// 使用一个计划任务每分钟执行
//// 1.写一个堵塞的程序
while(true){
    $user = $redis->brPop('user',59);
    if(!empty($user)){
        $re = $redis->sIsMember('result',$user[1]);
        if($re){    // 已抢单过
//    echo '已经抢过单了';
        }else{  // 还没有抢单
            $store = $redis->rPop('store');
//            var_dump($store);
            if($store !== false){
                $redis->sAdd('result',$user[1]);
                // 做数据库的操作
//        echo '抢单成功';
            }else{
                // 没有库存了
//        echo '没有库存了';
            }
        }
    }else{
        // 没有用户了就退出循环，免得消耗资源
        break;
    }
}
