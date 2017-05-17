<?php
if (rand(0,10) < 5) {
    $str = file_get_contents('./1.txt');
    $str++;
    file_put_contents('./1.txt', $str);
    echo "ok!";
}else{
    echo "no!";
}

