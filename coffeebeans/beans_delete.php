<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>原価率計算表</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
  
<?php

$code=$_GET['code'];
//var_dump($code);
try
{




$dsn='mysql:dbname=portfolio;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql="DELETE FROM beans WHERE code=?";
$stmt=$dbh->prepare($sql);
$list[]=$code;
$stmt->execute($list);

$dbh=null;



}

catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>
  
    
削除しました。<br />
<br />
<a href="coffee_top.php"> 戻る</a>

</body>
</html>
