<?php
sleep(5);
if(!empty($_FILES)){
    echo '<script>parent.document.getElementById("info").innerHTML = "上传成功!";console.log(parent);</script>';
}


