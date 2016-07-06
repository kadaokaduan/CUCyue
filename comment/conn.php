<?php
//header('Content-type: text/json');
//header("Access-Control-Allow-Origin:*");
$con = mysql_connect("localhost","root","");//连接数据库
       if(!$con){ die('could not connect:'.mysql_error()); }
       mysql_select_db("comment", $con);

?>
