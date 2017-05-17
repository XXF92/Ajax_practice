<?php
set_time_limit(0);
require_once('./Hel.class.php');
$he = Hel::getHel();

while (true) {
    if ($res = $he->sel('flag')) {
        echo json_encode($res);
        $he->change('flag');
        exit();
    }
    sleep(1);
}