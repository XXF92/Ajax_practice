<?php
$reg = 0;
if (isset($_POST) && !empty($_POST)) {
    $reg = 1;
}
// print_r($_POST);
?>
<script>
    alert('ok!');
    var info = parent.document.getElementById('info');
    info.innerHTML = '注册成功！';
 
</script>