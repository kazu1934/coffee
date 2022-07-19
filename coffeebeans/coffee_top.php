<!DOCTYPE html>

<html>
    <head>
        <title>原価率計算表</title>
        <meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header>
        <h1>
            自家焙煎コーヒー豆　ネットショップ
        </h1>
            <li>アプリの説明　ネットショップでの原価率計算表を制作いたしました。（コーヒー豆のお店を想定して）</br>
                　　　　　　　仕入価格や売価を入力すると、粗利額、粗利率も表示されます。必要に応じてファイルにダウンロードも出来ます。
                       　　　　
            </li>
        </header>
        <h2>
            原価率計算表
        </h2>


        <form method="post" action="beans_add_check.php" enctype="multipart/form-data">

            <li>商品名  <input type="text" name="name" style="width:150px" ></li> 
            <li> 仕入先 <select name="shop"></li>
            <option value="コーヒービーンズ俱楽部">コーヒービーンズ俱楽部</option>
            <option value="たかおマーケット">たかおマーケット</option>
        </select>
        <li>生豆原価 <input type="text" name="price" style="width:100px" ></li>
        <li>生豆目減り率  <select name="loss"></li>
        <option value="0.7">７０％</option>
        <option value="0.75">７５％</option>
        <option value="0.8">８０％</option>
        <option value="0.85">８５％</option>
    </select>
    <li>送料 <select name="send_price"></li>
    <option value="215">215</option>
    <option value="210">210</option>
    <option value="175">170</option>                
</select>
<li>手数料 <select name="charge"></li>
<option value="0.1">１０％</option>
<option value="0.07">７％</option>
<option value="0.05">５％</option>                
</select>
<li> 梱包代<input type="text" name="box" style="width:100px" ></li>
<li>雑費 <input type="text" name="other" style="width:100px" > </li>    
<li>売値 <input type="text" name="sale" style="width: 100px"></li>
<input type="submit" value="OK">
</form>


<?php
try {

    $dsn = 'mysql:dbname=portfolio;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM beans ';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    $list = [];
    $num = 0;
    while (true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rec == false) {
            break;
        }
        $cofee['code'] = $rec['code'];
        $cofee['name'] = $rec['name'];
        $cofee['shop'] = $rec['shop'];
        $cofee['price'] = $rec['price'];
        $cofee['loss'] = $rec['loss'];
        $cofee['send_price'] = $rec['send_price'];
        $cofee['charge'] = $rec['charge'];
        $cofee['box'] = $rec['box'];
        $cofee['other'] = $rec['other'];
        $cofee['sale'] = $rec['sale'];

        $list[$num] = $cofee;
        $num++;
    }
} catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>原価率計算表 </title>

    </head>
    <body>
        <table border="1"><!-- 練習 -->
            <caption><h3>商品一覧</h3></caption>
            <thead><tr><th>名前</th><th>仕入先</th><th>生豆原価</th><th>生豆目減り率</th><th>送料</th><th>手数料</th><th>梱包代</th><th>雑費</th><th>売値</th><th>粗利額</th><th>粗利率</th><th>削除</th></tr></thead>
<?php
// テーブルデータを1行ずつ表示
foreach ($list as $cofee) {
    // YYYY/MM/DD 曜日 HH:mm:ss　の形式に連結する
    // $date = "${gurume['date']} ${weekdays[$rec['weekday']]} ${gurume['time']}";
    ?>
                <tr>
                   
                    <td><?= htmlspecialchars($cofee['name']) ?></td>
                    <td><?= htmlspecialchars($cofee['shop']) ?></td>
                    <td><?= htmlspecialchars($cofee['price'])."円" ?></td>
                    <td><?= htmlspecialchars($cofee['loss']*100)."%" ?></td>
                    <td><?= htmlspecialchars($cofee['send_price']."円") ?></td>
                    <td><?= htmlspecialchars($cofee['charge']*100)."%" ?></td>
                    <td><?= htmlspecialchars($cofee['box']."円") ?></td>
                    <td><?= htmlspecialchars($cofee['other']."円") ?></td>
                    <td><?= htmlspecialchars($cofee['sale']."円") ?></td>
<td><?= htmlspecialchars(intval(($cofee['sale']-(($cofee['price']/$cofee['loss'])+$cofee['send_price']+$cofee['box']+$cofee['other']))*(1-$cofee['charge']))."円") ?></td>
<td><?= htmlspecialchars(intval((((($cofee['sale']-(($cofee['price']/$cofee['loss'])+$cofee['send_price']+$cofee['box']+$cofee['other']))*(1-$cofee['charge'])))/$cofee['sale'])*100)."％") ?></td>

<!--<td>[<a href="beans_delete.php?action=delete&code=$rec['code']">削除</a>]</td>-->
<td><a href="beans_delete.php?code=<?php echo $cofee['code'];?>">削除</a></td>
                </tr>
                
                <?php
            }
            ?>
        </table>
        </br>
        <h3>原価率計算表ダウンロード</h3>
        ファイルにダウンロードし、Excel等で利用出来ます。
        
<form method="post" action="beans_download_done.php">

</br>
<input type="submit" value="原価率計算表ダウンロードへ">
</form>

       

    </body>
</html>













