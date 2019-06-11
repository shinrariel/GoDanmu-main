
<?php
/*
 以下为原代码
	session_start();
	if(array_key_exists('uid', $_SESSION))
	{
		header("Location:/ass/login.action.php");
		exit();
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>互动审核系统 身份验证</title></head>
<h2>互动审核系统 身份验证</h2>
<form name="LoginForm" method="post" action="/ass/login.action.php">    
<p>  
<label for="password" class="label">密 码:</label>  
<input id="password" name="password" type="password" class="input">  
</p>
<p>  
<input type="submit" name="submit" value="  确 定  " class="left">  
</p>  
</form>  
<?php
	if(array_key_exists('wp', $_SESSION) && $_SESSION['wp']==1)
		echo("<br><br><p>密码位数不少于18位</p>");
?>
</html>
 */

 //以下为layui版本登陆界面
 ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="layui/css/layui.css">
        <style type="text/css">
      		.container{
      			width: 420px;
      			height: 320px;
		 		 min-height: 320px;  
		 		 max-height: 320px;  
		 		 position: absolute;   
		 		 top: 0;  
		 		 left: 0;  
		 		 bottom: 0;  
		 		 right: 0;  
		 		 margin: auto;  
		 		 padding: 20px;  
		 		 z-index: 130;  
		 		 border-radius: 8px;  
		 		 background-color: #fff;  
		 		 box-shadow: 0 3px 18px rgba(100, 0, 0, .5); 
		 		 font-size: 16px;
      		}
      		.close{
      			background-color: white;
      			border: none;
      			font-size: 18px;
      			margin-left: 410px;
      			margin-top: -10px;
      		}
 
        	.layui-input{
        		border-radius: 5px;
        		width: 300px;
        		height: 40px;
        		font-size: 15px;
        	}
        	.layui-form-item{
        		margin-left: -20px;
        	}
			#logoid{ 
				margin-top: -16px;
		 		 padding-left:150px; 
		 		 padding-bottom: 15px;
			}
			.layui-btn{
				margin-left: -50px;
				border-radius: 5px;
        		width: 350px;
        		height: 40px;
        		font-size: 15px;
			}
			.verity{
				width: 120px;
			}
			.font-set{
				font-size: 13px;
				text-decoration: none; 
				margin-left: 120px;
			}
			a:hover{
			 text-decoration: underline; 
			}
 
        </style>
    </head>
    <body>
    	<form class="layui-form" action="" method="post">
    		<div class="container">
    			<button class="close" title="关闭">X</button>
    				<div class="layui-form-mid layui-word-aux">
						辅助文字
						<?php
							//并没有好看的图片
							if( 0 )
							{
						?>
    					<img id="logoid" src=<?php /* TODO:登陆页面可变图片地址*/ echo 'img/login_header.png';?> height="35">    				
    					</div>
						<?php
							}
						?>
			  <div class="layui-form-item">
			    <label class="layui-form-label">用户名</label>
			    <div class="layui-input-block">
			      <input type="text" name="title" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
			    </div>
			  </div>
			  <div class="layui-form-item">
			    <label class="layui-form-label">密 &nbsp;&nbsp;码</label>
			    <div class="layui-input-inline">
			      <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
			    </div>
			  </div>
 			  <div class="layui-form-item">
				    <label class="layui-form-label">记住密码</label>
					<?php
					//TODO:当前版本前端没有实现记住密码，只是好看
					?>
				    <div class="layui-input-block">
				      <input type="checkbox" name="close" lay-skin="switch" lay-text="当然啦|我怕怕">
				    </div>
			  </div> 
				
			  <div class="layui-form-item">
			    <div class="layui-input-block">
			      <button class="layui-btn" lay-submit lay-filter="formDemo">登陆</button>	     
			    </div>
			  </div>
			  <?php 
			  	//TODO:读取配置文件设定是否允许开放注册以及找回密码 
			  ?>
				<!--
				Debug：超级管理员配置了不允许开放注册以及找回密码
			   <a href="" class="font-set">忘记密码?</a>  <a href="" class="font-set">立即注册</a>
			   -->
			</div>
		</form>
		<script type="text/javascript" src="layui/layui.js"></script>
		<script>
			layui.use(['form', 'layedit', 'laydate'], function(){
			  var form = layui.form
			  ,layer = layui.layer
			  ,layedit = layui.layedit
			  ,laydate = layui.laydate;
			  
			  //日期
			 /* laydate.render({
			    elem: '#date'
			  });
			  laydate.render({
			    elem: '#date1'
			  });
			  
			  //创建一个编辑器
			  var editIndex = layedit.build('LAY_demo_editor');
			 */
			  //自定义验证规则
			  form.verify({
			    title: function(value){
			      if(value.length < 5){
			        return '标题至少得5个字符啊';
			      }
			    }
			    ,pass: [
			      /^[\S]{6,12}$/
			      ,'密码必须6到12位，且不能出现空格'
			    ]
			    ,content: function(value){
			      layedit.sync(editIndex);
			    }
			  });
			  
			  //监听指定开关
			  form.on('switch(switchTest)', function(data){
			    layer.msg('开关checked：'+ (this.checked ? 'true' : 'false'), {
			      offset: '6px'
			    });
			    layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是ON|OFF', data.othis)
			  });
			  
			  //监听提交
			  form.on('submit(demo1)', function(data){
			    layer.alert(JSON.stringify(data.field), {
			      title: '最终的提交信息'
			    })
			    return false;
			  });

			  
			  
			});
			</script>
    </body>
