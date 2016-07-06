<?php
include("conn.php");
//$txt="Hello world!";
//echo $txt;           //测试

//验证参数

    //  echo '<pre>',var_dump($_REQUEST['comment']),'</pre>';
	//if(isset($_GET['comment']))
	//{
	//echo '"'.$_POST['comment'].'"被捕捉到了。';
	$comment=$_POST['comment'];	
	//$comment=$GET['comment'];	
	$user_name="小小红色飞机";
	$time=date('Y-m-d h:i:sa',time()); 
	//}	
	//echo $comment;
	//echo $user_name;
	//echo $time;


$sql="INSERT INTO acomment(user_name,content,time) VALUES('$user_name','$comment','$time')";//将学号插入数据表
mysql_query($sql,$con);
echo "succeed";
mysql_close($con);
?>

