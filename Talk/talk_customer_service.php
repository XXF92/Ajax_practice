<?php setcookie('name','客服');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keyword" content="布尔教育">
    <title>即时聊天(客服端)-使用iframe长连接完成</title>
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
        <h3>即时聊天(客服端)-使用iframe长连接完成</h3>
        <div id="talk">
            
        </div>
        <div id="reply">
            <h5>回复用户:<span id="reply_user"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span>(请点击聊天框里的用户选择)</span></h5>
            <textarea name="answer" id="answer" cols="97" rows="5"></textarea>
            <p><input type="button" value="回复" onclick="answer();"></p>
        </div>
        <iframe src="./talk_customer_service_back.php" frameborder="0" width="0" height="0"></iframe>
    </div>
    
    <script>
        //输出新的用户回复
        function printReply(talkObj,reply){
            var d = new Date();
            var date = d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes();
            if(reply.rep != ''){
                var rep = ' 回复 '+reply.rep;
            }else{
                var rep = '';
            }
            talkObj.innerHTML += '<div id="list"><div class="user">用户:&nbsp;<span onclick="getName(\''+reply.name+'\');">'+reply.name+'</span>'+rep+'&nbsp;&nbsp;&nbsp;&nbsp;<span>发送时间:&nbsp;&nbsp;&nbsp;&nbsp;'+date+'</span></div><div class="reply">'+reply.com+'</div></div>';
        }
        //通过点击获取回复的用户
        function getName(name){
            document.getElementById('reply_user').innerHTML = name;
        }
        //客户回复用户
        function answer(){
            var rep = document.getElementById('reply_user').innerHTML;
            var com = document.getElementById('answer').value;
            if(rep == '' || com == ''){
                alert('请选择回复人并输入回复!');
                return;
            }
            //Ajax发送回复内容到后台入库
            var xhr = new XMLHttpRequest();
            xhr.open('POST','service_reply.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xhr.send('rep='+rep+'&com='+com);
            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4){
                    // console.log(xhr.responseText);
                    alert('你回复 '+rep+' 的内容是:'+com);
                    document.getElementById('answer').value = '';
                }
            }

            
        }

    </script>
</body>
</html>
