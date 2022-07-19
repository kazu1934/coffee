<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>原価率計算表</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php

try
{
$pro_name=$_POST['name'];
$pro_shop=$_POST['shop'];
$pro_price=$_POST['price'];
$pro_loss=$_POST['loss'];
$pro_send_price=$_POST['send_price'];
$pro_charge=$_POST['charge'];
$pro_box=$_POST['box'];
$pro_other=$_POST['other'];
$pro_sale=$_POST['sale'];


$dsn='mysql:dbname=portfolio;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='INSERT INTO beans (name,shop,price,loss,send_price,charge,box,other,sale) VALUES (?,?,?,?,?,?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data[]=$pro_name;
$data[]=$pro_shop;
$data[]=$pro_price;
$data[]=$pro_loss;
$data[]=$pro_send_price;
$data[]=$pro_charge;
$data[]=$pro_box;
$data[]=$pro_other;
$data[]=$pro_sale;

$stmt->execute($data);

$dbh=null;


print '一件追加しました。<br />';

}
catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<a href="coffee_top.php"> 戻る</a>

</body>
</html>

