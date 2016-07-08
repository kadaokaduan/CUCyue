<!DOCTYPE html>
<html lang="zh" style="height:100%">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/sinaFaceAndEffec.css" />

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

<script type="text/javascript">
    var ifout=false;
    function out()
	{
		if(ifout)
		{
			document.getElementById("contents").style.display="none";
			ifout=false;
			
		}
		else
		{
			document.getElementById("contents").style.display="";
			ifout=true;
		}
		
	}

</script>

<?php
  include("conn.php");
  $sql="SELECT user_name,content,time FROM acomment";
  $all=mysql_query($sql,$con);
  $Row=mysql_fetch_row($all);
?>

<title>qq表情留言评论</title>
<style type="text/css" >

.content{width: 96%; height: 120px; float: left;margin:5px;}

.cont-box{ width: 100%; height: 80px; border: 1px solid #99cc66; border-top-left-radius: 5px;  border-top-right-radius: 5px; float: left;}
.cont-box .text{ width: 80%; height: 86.9%; border-radius: 5px;   padding: 5px 10px; color: #999; font-family: "微软雅黑"; font-size: 12px; resize:none; border: none;  outline: none; float: left;}

.tools-box{ width: 100%; height: 30px; border: 1px solid #99cc66; margin-top: 5px; border-bottom-left-radius: 5px;  border-bottom-right-radius: 5px; float: left;}
.tools-box .operator-box-btn{ width: 85%; height: 30px; float: left;  }
.tools-box .operator-box-btn .face-icon{display: block; float: left; margin-top:-1px; margin-left: 10px; font-family: "微软雅黑"; font-size: 22px; color: #99cc66;  cursor: pointer;}
.tools-box .operator-box-btn .img-icon{display: block; float: left; margin-top:-11px; margin-left: 10px; font-family: "微软雅黑"; font-size: 33px; font-weight: lighter; color: #99cc66; cursor: pointer;}
.tools-box .submit-btn{ width: 15%; height: 30px; float: right; }

.tools-box .submit-btn input{ width: 100%; height: 100%; font-family: "微软雅黑"; font-size: 14px; color: #fff; cursor: pointer; border: none; outline: none; background-color: #99cc66;}

/* 回复信息 */
#info-show{float: left;  width: 100%; margin-top: 0px;}
#info-show li{ width: 100%; height: auto; padding: 10px 0 20px 0; border-bottom: 1px dashed #c0c0c0; float: left;list-style-type:none;float: left;}
#info-show .head-face{width: 10%;  float: left; text-align: center;}
#info-show .head-face img{width: 50px; height: 50px; border-radius: 50%; box-shadow: 0 0 8px #c0c0c0;}

#info-show .reply-cont{ width: 89%; padding-right: 1%; float: right;}
#info-show .reply-cont  p{ min-height: 20px; line-height: 20px;  font-family: "微软雅黑"; font-size: 14px;}
#info-show .reply-cont .username{ color: #99cc66; margin-bottom: 5px;}
#info-show .reply-cont .comment-body{ color: #999; max-height: auto;}
#info-show .reply-cont .comment-footer{font-size: 12px; color: #c0c0c0; margin-top: 10px;}
</style>
</head>

<body style="margin:0;height:100%;background:white;overflow: hidden;">
<div id="content" style="width:100%;height:100%;margin:0;position: relative;">
   <div class="info-man" style="width:15%;height:120px;float:left;text-align:center;;margin:20px 0px 0px 5px;">  
	     <img src="images/1.jpg" style="width:50px;height:50px;"/>
   </div>
	
   <div class="say-man" style="width:80%;height:100%;float:left;margin:0;margin-top:15px;">
      
	  <p style="font-size: 15px; font-family: 微软雅黑;margin:10px;margin-top:1px;color: #576b95;">我是猪</p>
	  <p style="font-size: 15px; font-family: 微软雅黑;margin:10px;">当content的高度超过box的高度的时候，超出的部分就会被隐藏。这就是隐藏溢出的含义！</p>
	  <img src="images/1.jpg" style="width:80%;height:250px;margin:10px;"/>
   
      <div class="last" style="width:100%;height:20px;margin:0;position: relative;">
	    <p style="font-size: 15px; width:30%;font-family: 微软雅黑;margin:0; margin-left:5px;margin-right:5px;opacity:0.4;float: left;">15分钟前</p>
	    <input type="button" onClick="out()"value="评论" style="width: 15%; height: 20px; font-family: 微软雅黑; font-size: 15px; color: #fff; cursor: pointer; border: none; outline: none; background-color: gray;float: right;margin-right:10px;"/>
      </div>
	  
	  
	 <ul style="list-style:none;">
	  <li>
	  <div class="comment" style="width:100%;height:60px;margin:0;position: relative;">
	    <img src="images/1.jpg" style="width:50px;height:50px;margin:0;margin-right:10px;margin-top:10px;float:right;"/>
	    <p style="font-size: 15px; font-family: 微软雅黑;width:70%;margin:0;margin-top:10px;margin-left:5px;float:left;">超出的部分就会被隐藏。这就是隐藏溢出的含义！</p>
	  </div></li>
	  <li>
	  <div class="comment" style="width:100%;height:60px;margin:0;position: relative;">
	    <img src="images/1.jpg" style="width:50px;height:50px;margin:0;margin-right:10px;margin-top:10px;float:right;"/>
	    <p style="font-size: 15px; font-family: 微软雅黑;width:70%;margin:0;margin-top:10px;margin-left:5px;float:left;">超出的部分就会被隐藏。这就是隐藏溢出的含义！</p>
	  </div>
	  </li>
	
	 
	<?php
	  while($Row=mysql_fetch_row($all))
		{
				
		echo'
		<li>
		<div class="comment" style="width:100%;height:60px;margin:0;position: relative;">
	    <img src="images/1.jpg" style="width:50px;height:50px;margin:0;margin-right:10px;margin-top:10px;float:right;"/>
	    <p style="font-size: 15px; font-family: 微软雅黑;width:70%;margin:0;margin-top:10px;margin-left:5px;float:left;">'.$Row["content"].'</p>
	    </div></li>';
			}
			
	?>
	 </ul>
	
	
  
      <div class="content" id="contents" style="display:none;position:absolute;top:0px;right:0px;left:0px;">
				<div class="cont-box">
					<textarea class="text" placeholder="请输入..." style="background-color:white;"></textarea>
				</div>
				<div class="tools-box">
					<div class="operator-box-btn"><span class="face-icon"  >☺</span><span class="img-icon">▧</span></div>
					<div class="submit-btn"><input type="button" onClick="send()"value="发送" /></div>
				</div>
      </div>
	
   </div>
	



</div>
<script type="text/javascript" src="js/sinaFaceAndEffec.js"></script>
<script type="text/javascript">
	// 绑定表情
	$('.face-icon').SinaEmotion($('.text'));
	// 测试本地解析
	function send() {
		var inputText = $('.text').val();
		
		
		if((inputText+"").length==0)
		{
		  alert("评论不能为空");
		}
		else if((inputText+"").length>20)
		{
		 alert("评论过长，请小于100字");
		}
		else{
         PostData(inputText);
		 $('#content ul').append(reply(AnalyticEmotion(inputText)));
		}
	}
	
	var html;
	function reply(content){
		html  = '<li><div class="comment" style="width:100%;height:60px;margin:0;position: relative;">';
		html += ' <img src="images/1.jpg" style="width:50px;height:50px;margin:0;margin-right:10px;margin-top:10px;float:right;"/>';
		html += '<p style="font-size: 15px; font-family: 微软雅黑;width:70%;margin:0;margin-top:10px;margin-left:5px;float:left;">'+content+'</p>';
		html += '</div></li>';
		return html;
	}
	
	function PostData(content) { 
	    
	    $.ajax({ 
		        type: "POST", 
				url: "getComment.php", 
				data : {"comment":content}, 
				success:function(result){  console.log("succes"); },
				error:function(msg){  alert('Error:'+msg);}
			    });
		   }
</script>
</body>