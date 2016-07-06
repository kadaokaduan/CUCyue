<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=no, width=device-width, height=device-height,initial-scale=1, maximum-scale=1">
<link  rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/sinaFaceAndEffec.css" />

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<?php
  include("conn.php");
  $sql="SELECT user_name,content,time FROM acomment";
  $all=mysql_query($sql,$con);
  $Row=mysql_fetch_row($all);
?>


<title>jQuery多说QQ表情留言评论框代码</title>
</head>
<body>
<div id="content" style="width: 700px; height: auto;margin-left:320px;margin-top:40px">
	<div class="wrap">
		<div class="comment">
			<div class="head-face">
				<img src="images/1.jpg" />
				<p>我是鸟</p>
			</div>
			<div class="content">
			  
				<div class="cont-box">
					<textarea class="text" placeholder="请输入..."></textarea>
				</div>
				<div class="tools-box">
					<div class="operator-box-btn"><span class="face-icon"  >☺</span><span class="img-icon">▧</span></div>
					<div class="submit-btn"><input type="button" onClick="out()"value="提交评论" /></div>
				</div>
			
			</div>
		</div>
		<div id="info-show">
			<ul>
			<?php
			while($Row=mysql_fetch_row($all))
			{
				
				echo'
				<li>
				<div class="head-face">
				<img src="images/1.jpg" / >
				</div>
				<div class="reply-cont">
				<p class="username">'.$Row["user_name"].'</p>
				<p class="comment-body">'.$Row["content"].'</p>
				<p class="comment-footer">2016年10月5日　回复　点赞54　转发12</p>
				</div>
				</li>
				';
			}
			
			?>
			</ul>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/sinaFaceAndEffec.js"></script>
<script type="text/javascript">
	// 绑定表情
	$('.face-icon').SinaEmotion($('.text'));
	// 测试本地解析
	function out() {
		var inputText = $('.text').val();
		
		
		if((inputText+"").length==0)
		{
		  alert("评论不能为空");
		}
		else if((inputText+"").length>100)
		{
		 alert("评论过长，请小于100字");
		}
		else{
		

         PostData(inputText);
		
		
		 $('#info-show ul').append(reply(AnalyticEmotion(inputText)));
		 
		
		 
		
		
		}
		
	}
	
	var html;
	function reply(content){
		html  = '<li>';
		html += '<div class="head-face">';
		html += '<img src="images/1.jpg" / >';
		html += '</div>';
		html += '<div class="reply-cont">';
		html += '<p class="username">小小红色飞机</p>';
		html += '<p class="comment-body">'+content+'</p>';
		html += '<p class="comment-footer">2016年10月5日　回复　点赞54　转发12</p>';
		html += '</div>';
		html += '</li>';
		return html;
	}
	
	function PostData(content) { 
	    
	    $.ajax({ 
		        type: "POST", 
				url: "getComment.php", 
				data : {"comment":content}, 
				success:function(result){  $("#comlist").empty().append(result);  },
				error:function(msg){  alert('Error:'+msg);}
			    });
		   }
</script>
<div style="text-align:center;" id="comlist">

</div>
</body>
</html>

