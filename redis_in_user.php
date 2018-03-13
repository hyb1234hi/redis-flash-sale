<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/13 0013
 * Time: 10:48
 */

$redis = new Redis();
// 用户入队列
// 查剩余库存量
$redis->connect('127.0.0.1',6379);
// 模拟前台下单的过程
$rand = rand(1,1000);
$redis->rPush('user',$rand);
