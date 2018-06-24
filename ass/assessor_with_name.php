<?php
session_start();
if(empty($_SESSION["UID"]))
{
    header("Location:index.php");
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>
        body,
        html {
            height: 100%;
            background-color: #f8f8f8
        }
        
        body {
            font-family: -apple-system-font, Helvetica Neue, Helvetica, sans-serif
        }
        
        .item {
            padding: 10px 0
        }
        
        .item__title {
            margin-bottom: 5px;
            padding-left: 15px;
            padding-right: 15px;
            color: #999;
            font-weight: 400;
            font-size: 14px
        }
        
        .item__ctn {
            padding: 0 15px
        }
        
        .page_feedback {
            padding: 15px;
            overflow: auto;
            background-color: #FFF
        }
        
        label>* {
            pointer-events: none
        }
        
        .weui-picker__item {
            padding: 0;
            height: 34px;
            line-height: 34px
        }
    </style>
    <script type="text/javascript" src="http://res.wx.qq.com/open/libs/weuijs/1.1.3/weui.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="http://cdn.bootcss.com/vue/2.5.16/vue.js"></script>
    <script type="text/javascript" src="wsconnect_ass.js"></script>
	<title>审核页面</title>
</head>
<body>
<h1>审核页面 </h1>
    <form id="server_setting">
        <input type="text" id="ip" value="shinrariel.com" hidden>
        <input type="text" id="port" value="8090" hidden>
		<input type="text" id="sendport" value="8172" hidden>
        <button type="button" onclick="start()">连接到服务器</button>
    </form>
	<table id="s_msg">
		<tbody>
			<tr>
				<td>时间</td>
				<td>来源</td>
				<td>内容</td>
				<td>操作</td>
			</tr>
			<tr v-for="ms in show" :id="ms.msgid">
				<td>{{ ms.time }}</td>
				<td>{{ ms.mame }}</td>
				<td>{{ ms.msg_body }}</td>
				<td><button type="button" v-on:click="msg_send_vue(ms.time,ms.name,ms.msg_body);changeline(ms.msgid,'line-through')">通过</button></td>
			</tr>
		</tbody>
	</table>
	</tr>
</div>
<script>
        var msshow = new Vue({
            el: '#s_msg',
            data: {
                show: window.message
            },
			methods:{
				msg_send_vue:function(time,name,msg_body){
					var msgip = document.getElementById("ip").value;
					var msport = document.getElementById("sendport").value;
					$.post("http://" + msgip + ":" + msport + "/1/push/all", JSON.stringify({
						"msg_body": msg_body,
						"name": name,
						"time": time
					}), "json");
				},
				changeline:function(id,x){
					document.getElementById(id.toString()).style.textDecoration = x;
				}
			}
        })
    </script>
</table>
</body>
</html>