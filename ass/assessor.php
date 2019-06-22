<?php
    session_start();
    require 'class/checklogin.class.php';
    if (!allowLogin()) {
        header("Location:index.php");
    }
    $user = $_SESSION['uid'];
?>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="layui/css/layui.css">
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
        <input type="text" id="ip" value="219.147.208.231" hidden>
        <input type="text" id="port" value="8090" hidden>
        <input type="text" id="sendport" value="17172" hidden>
    </form>
    <div id="mainbox">
        <table width="100%" border="1" cellpadding="0" cellspacing="0">
            <table id="s_msg" class="layui-table">
                <tbody>
                    <tr>
                        <th style="width:9%;">时间</th>
                        <th style="width:10%;">用户</th>
                        <th style="min-width:150px;">内容</th>
                        <th style="width:5%;">操作</th>
                    </tr>
                    <tr class="height=27px;" v-for="ms in show" :id="ms.msgid">
                        <td>{{ ms.time }}</td>
                        <td>{{ ms.name }}</td>
                        <td>{{ ms.msg_body }}</td>
                        <td><button type="button" class="layui-btn" v-on:click="msg_send_vue(ms.time,ms.name,ms.msg_body);changeline(ms.msgid,'line-through')">通过</button></td>
                    </tr>
                </tbody>
            </table>
    </div>
    <script>
        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
    </script>
    <script>
        var msshow = new Vue({
            el: '#s_msg',
            data: {
                show: window.message
            },
            methods: {
                msg_send_vue: function(time, name, msg_body) {
                    var msgip = document.getElementById("ip").value;
                    var msport = document.getElementById("sendport").value;
                    $.post("http://" + msgip + ":" + msport + "/1/push/all", JSON.stringify({
                        "msg_body": name + ": " + msg_body,
                        "time": time
                    }), "json");
                    var server = "localdanmudev";
                    var logp = "60000";
                    var ass = "<?php echo $user; ?>";
                    $.post("http://" + server + ":" + logp + "/ass/api/log.api.php", JSON.stringify({
                        "type": "1",
                        "assessor": ass,
                        "msg_body": name + ": " + msg_body,
                        "time": time,
                        "session": getCookie()
                    }), "json");
                },
                changeline: function(id, x) {
                    document.getElementById(id.toString()).style.textDecoration = x;
                }
            }
        })
    </script>
    <script type="text/javascript">
        start();
    </script>
    </table>
</body>

</html>