<?php
// 大文件切割上传
if (!empty($_FILES)) {
    //获取后缀
    $type = substr($_FILES['file']['type'],(strpos($_FILES['file']['type'],'/')+1));
    $fileurl = './upload/up.'.$type;//随机建立文件名
    // 判断文件是否存在
    if (!file_exists($fileurl)) {
        move_uploaded_file($_FILES['file']['tmp_name'], $fileurl);
    }else{
        //如果存在文件则往文件后追加内容
        file_put_contents($fileurl,file_get_contents($_FILES['file']['tmp_name']),FILE_APPEND);
    }
    print_r($_FILES);
    echo "ok!";
}