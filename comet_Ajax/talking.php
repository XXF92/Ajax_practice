<?php
set_time_limit(0);
require_once('./Hel.class.php');
//输出缓存
ob_start();
$h1 = Hel::getHel();
while(true){
    //判断是否有新消息
    if ($newArr = $h1->sel()) {
        $rep = str_repeat(' ', 40000);
        foreach ($newArr as $k => $v) {
            echo $v['name'].'说:'.$v['com'].$rep.' 发送时间:'.date('Y-m-d',time()).'  <br/>';
            ob_flush();
            flush();
        }
        //把消息改为已读
        $h1->change();
    } 
    sleep(2);
}

