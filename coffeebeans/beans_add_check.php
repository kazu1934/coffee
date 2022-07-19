
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>原価率計算表</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php



//$post= sanitize($_POST);
$pro_name=$_POST['name'];
$pro_shop=$_POST['shop'];
$pro_price=$_POST['price'];
$pro_loss=$_POST['loss'];
$pro_send_price=$_POST['send_price'];
$pro_charge=$_POST['charge'];
$pro_box=$_POST['box'];
$pro_other=$_POST['other'];
$pro_sale=$_POST['sale'];

if($pro_name=='')
{
	print '商品名が入力されていません。<br />';
}
else
{
	print '商品名:';
	print $pro_name;
	print '<br />';
}


if($pro_shop=='')
{
	print '仕入先が入力されていません。<br />';
}
else
{
	print '仕入先:';
	print $pro_shop;
	print '<br />';
}
{
	print '生豆原価100g:';
	print $pro_price;
	print '円<br />';
}
print '歩留まり率:';
	print $pro_loss*100;
	print '％<br />';

if(preg_match('/\A[0-9]+\z/',$pro_price)==0)
{
	print '価格をきちんと入力してください。<br />';
}
else




if(preg_match('/\A[0-9]+\z/',$pro_box)==0)
{
	print '送料をきちんと入力してください。<br />';
}
else
{
	print '送料:';
	print $pro_box;
	print '円<br />';
}

print '手数料:';
	print $pro_charge*100;
	print '%<br />';

      print '梱包代:';
	print $pro_box;
	print '円<br />';  
        
if(preg_match('/\A[0-9]+\z/',$pro_other)==0)
{
	print '雑費をきちんと入力してください。<br />';
}
else
{
	print '雑費:';
	print $pro_other;
	print '円<br />';
}
if(preg_match('/\A[0-9]+\z/',$pro_sale)==0)
{
	print '売価をきちんと入力してください。<br />';
}
else
{
	print '売価:';
	print $pro_sale;
	print '円<br />';
}


if($pro_name=='' || $pro_shop=='' || preg_match('/\A[0-9]+\z/',$pro_price)==0 || preg_match('/\A[0-9]+\z/',$pro_box)==0 || preg_match('/\A[0-9]+\z/',$pro_other)==0 || preg_match('/\A[0-9]+\z/',$pro_sale)==0)
{
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}
else
{
	print '上記の内容を追加します。<br />';
	print '<form method="post" action="beans_add_done.php">';
	print '<input type="hidden" name="name" value="'.$pro_name.'">';
	print '<input type="hidden" name="shop" value="'.$pro_shop.'">';
	print '<input type="hidden" name="price" value="'.$pro_price.'">';
        print '<input type="hidden" name="loss" value="'.$pro_loss.'">';
        print '<input type="hidden" name="send_price" value="'.$pro_send_price.'">';
        print '<input type="hidden" name="charge" value="'.$pro_charge.'">';
        print '<input type="hidden" name="box" value="'.$pro_box.'">';
        print '<input type="hidden" name="other" value="'.$pro_other.'">';
        print '<input type="hidden" name="sale" value="'.$pro_sale.'">';
        
	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="ＯＫ">';
	print '</form>';
}

?>
</body>
</html>

