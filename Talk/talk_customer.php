<?php 
if(!isset($_COOKIE['name'])){
    setcookie('name','user_'.rand(10000,99999));
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keyword" content="布尔教育">
    <title>即时聊天(用户端)-使用Ajax长连接完成</title>
   <style>
        .content{
          margin:0 auto;
          width:800px;
          height:700px;
          background-color: pink;
          padding: 0 50px;
        }
        h3{
            text-align: center;
        }
        #talk{
            height:400px;
            border: 1px solid blue;
            background-color: white;
            overflow: scroll;
        }
        .user{
            padding-left:20px;
            font-size:16px;
            font-weight: 600;
            border-bottom: 1px dashed blue;
        }
        .reply{
            padding-left:30px;
            padding-top:5px;
            font-size:20px;
            font-weight: 400;
            margin-bottom:20px;
        }
        
    </style>
    
</head>
<body>
    <div class="content">
        <h3>即时聊天(用户端)-使用Ajax长连接完成</h3>
        <div id="talk">
            <div id="list"><div class="user">&nbsp;&nbsp;<span>客服说:</span>&nbsp;&nbsp;&nbsp;&nbsp;<span></span></div><div class="reply">你想咨询什么？</div></div>
        </div>
        <div id="reply">
            <h5>用户:<span><?php echo $_COOKIE['name']; ?></span></h5>
            <textarea name="com" id="com" cols="97" rows="5"></textarea>
            <p><input type="button" value="咨询" onclick="ask();"></p>
        </div>
    </div>
    
    <script>
        //接受新回复
        var st = function(){
            var xhr = new XMLHttpRequest();
            xhr.open('GET','./talk_customer_back.php',true);
            xhr.send();
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4) {
                    var res = eval(xhr.responseText); 
                    console.log(res);
                    printReply(res[0]);         
                    st();
                    
                }
            }
        };
        (function(){
            st();
        })()
        
        //发表咨询
        function ask(){
            var com = document.getElementById('com').value;
            if(com == ''){
                alert('请输入回复内容!');
                return;
            }
            var xhr = new XMLHttpRequest();
            xhr.open('POST','./customer_ask.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xhr.send('com='+com);
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4) {
                    alert('发送成功!');
                    document.getElementById('com').value = '';
                }
            }
        }
        
        //输出新的回复
        function printReply(reply){
            var d = new Date();
            var date = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes();
            if(reply.rep != ''){
                var rep = ' 回复 '+reply.rep;
            }else{
                var rep = '';
            }
            document.getElementById('talk').innerHTML += '<div id="list"><div class="user">用户:&nbsp;<span onclick="getName(\''+reply.name+'\');">'+reply.name+'</span>'+rep+'&nbsp;&nbsp;&nbsp;&nbsp;<span>发送时间:&nbsp;&nbsp;&nbsp;&nbsp;'+date+'</span></div><div class="reply">'+reply.com+'</div></div>';
        }
    </script>
</body>
</html>
