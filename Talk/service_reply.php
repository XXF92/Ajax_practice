<?php
require_once('./Hel.class.php');
if (!empty($_POST)) {
    $rep = $_POST['rep'];
    $com = $_POST['com'];
    $name = $_COOKIE['name'];

    //入库
    $he = Hel::getHel();
    $he->insert($name,$rep,$com);

}

