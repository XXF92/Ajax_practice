<?php
require('./Hel.class.php');
print_r($_POST);
$he = Hel::getHel();
if (!empty($_POST)) {
    $name = $_COOKIE['name'];
    $rep = '客服';
    $com = $_POST['com'];
    $he->insert($name,$rep,$com);

}

