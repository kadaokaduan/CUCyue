<?php
$token = '0';
if(isset($_POST['stuid'])&isset($_POST['token'])&isset($_POST['password'])&isset($_POST['captcha']))
{
	$stuid = $_POST['stuid'];
	$password = $_POST['password'];
	$token = $_POST['token'];
	$captcha = $_POST['captcha'];
}
else
{
	returnquery('1', $token);
}
?>

<?php
$cookieVerify = dirname(__FILE__)."/checkusr/".$_POST['stuid'].".tmp";
$cookieSuccess = dirname(__FILE__)."/checkusr/".$_POST['stuid']."p.tmp";
include("../new/php/conn.php");
$sql = mysql_query("SELECT * FROM captcha WHERE stuid = '$stuid' ");
if(!$sql)
{
	returnquery('2',$token);
}
$row = mysql_fetch_array($sql);
if(!$row)
{
	returnquery('3', $token);
}
$cookieVerify = $row['cookie'];
$token = $row['token'];

// 登录
$ch = curl_init(); 
$url = "http://jw.cuc.edu.cn/academic/j_acegi_security_check?button1 = %B5%C7+%C2%BC"; 

// 返回结果存放在变量中，不输出 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieVerify);
curl_setopt($ch, CURLOPT_HEADER, 1); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); 
curl_setopt($ch, CURLOPT_POST, true); 
$fields_post = array("j_username"=> $stuid, "j_password"=> $password, "j_captcha"=>$captcha); 
$headers_login = array("User-Agent" => "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36"); 
$fields_string = ""; 
foreach($fields_post as $key => $value){ 
	$fields_string .= $key . "=" . $value . "&"; 
} 
$fields_string = rtrim($fields_string , "&"); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_login); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieSuccess);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result= curl_exec($ch);
curl_close($ch);

if (preg_match("/(login_error)/is", $result)){ 
	//echo "验证失败！请返回重试"; 
	returnquery('4',$token);
}else{ 
	//include("../new/php/verifystuid.php?stuid="+$stuid);
	$flag = mysql_query("INSERT INTO authentication_str(time,stuid)	VALUES(NOW(),'$stuid')");
	// echo "<br/>";
	// echo "<br/>";
	// echo "<br/>";
	if($flag)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://jw.cuc.edu.cn/academic/student/studentinfo/studentInfoModifyIndex.do?frombase=0&wantTag=0&groupId=&moduleId=2060");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieSuccess);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$rs = curl_exec($ch);
		preg_match_all('/value=(.*?)>(.*?)<em class="error">/', $rs, $m);
		preg_match_all('/value=(.*?)>(.*?)<\/div><em class="error">/', $rs, $n);


		$stuid = $m[2][0];
		$name = $m[2][1];
		$sex = $m[2][4];
		$school = $m[2][29];
		$major = $n[2][0];
		$study_year = $n[2][1];
		$class = $n[2][3];

		$resultend = mysql_query("INSERT INTO cucyueinfo(stuid,name,sex,school,major,study_year,class)VALUES('$stuid','$name','$sex','$school','$major','$study_year','$class')");
		echo mysql_error();
        curl_close($ch);

	}
	if($resultend){
		//echo "验证成功！请返回注册页面";
		returnquery('0',$token); 
	}
	else{
		//echo "数据库写入失败！请返回重试";
		returnquery('01',$token);
	}
} 

?>
<?php
function returnquery($error_code,$token){
    $val['flag'] = $error_code;
    $val['token'] = $token;
    $json = json_encode($val);
    unset ($val);       
    echo $json; 
    exit;
}
?>