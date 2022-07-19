<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>原価率計算表</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <?php
        try {



            $dsn = 'mysql:dbname=portfolio;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = '
SELECT * from beans
	
';
            $stmt = $dbh->prepare($sql);

            $stmt->execute();

            $dbh = null;

            $csv = 'コード,名前,仕入先,生豆原価,生豆目減り率,送料,手数料,梱包代,雑費,売値,粗利額,粗利率';
            $csv .= "\n";
            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec == false) {
                    break;
                }
                $csv .= $rec['code'];
                $csv .= ',';
                $csv .= $rec['name'];
                $csv .= ',';
                $csv .= $rec['shop'];
                $csv .= ',';
                $csv .= $rec['price'];
                $csv .= ',';
                $csv .= $rec['loss'];
                $csv .= ',';
                $csv .= $rec['send_price'];
                $csv .= ',';
                $csv .= $rec['charge'];
                $csv .= ',';
                $csv .= $rec['box'];
                $csv .= ',';
                $csv .= $rec['other'];
                $csv .= ',';
                $csv .= $rec['sale'];
                $csv .= ',';
                
                $csv .= "\n";
            }

//print nl2br($csv);

            $file = fopen('./beans.csv', 'w');
            $csv = mb_convert_encoding($csv, 'SJIS', 'UTF-8');
            fputs($file, $csv);
            fclose($file);
        } catch (Exception $e) {
            print 'ただいま障害により大変ご迷惑をお掛けしております。';
            exit();
        }
        ?>

        <a href="beans.csv">注文データのダウンロード</a><br />
        <br />

        <a href="http://localhost/portfolio01/coffeebeans/coffee_top.php">トップメニューへ</a><br />

    </body>
</html>