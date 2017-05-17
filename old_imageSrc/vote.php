<?php
$str = file_get_contents('./count.txt');
$str++;
file_put_contents('./count.txt', $str);
// echo "$str";
// header('Http/1.1 204',true,204);