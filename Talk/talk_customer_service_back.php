<?php
set_time_limit(0);
require_once('./Hel.class.php');
//输出缓存
ob_start();
$h1 = Hel::getHel();
while(true){
    //判断是否有新消息
    if ($newArr = $h1->sel('se_flag')) {
        $rep = str_repeat(' ', 40000);
        foreach ($newArr as $k => $v) {
            $json = json_encode($v);
            echo '<script>parent.window.printReply(parent.document.getElementById("talk"),'.$json.')</script>'.$rep;
            ob_flush();
            flush();
        }
        //把消息改为已读
        $h1->change('se_flag');
    } 
    sleep(1);
}

