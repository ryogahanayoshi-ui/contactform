<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

mb_internal_encoding("utf8");

try {
    $pdo = new PDO("mysql:dbname=lesson01;host=localhost;", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "DB接続エラー: " . $e->getMessage();
    exit;
}

// POSTデータが届いているか確認（デバッグ用）
// var_dump($_POST);

$sql = "INSERT INTO contactform (name, mail, age, comments) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(1, $_POST['name'], PDO::PARAM_STR);
$stmt->bindValue(2, $_POST['mail'], PDO::PARAM_STR);
$stmt->bindValue(3, $_POST['age'], PDO::PARAM_INT);
$stmt->bindValue(4, $_POST['comments'], PDO::PARAM_STR);

$stmt->execute();
?>

<!doctype HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>送信完了</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
    <h1>お問い合わせフォーム</h1>
    <div class="confirm">
        <p>
            お問い合わせありがとうございました。<br>
            3営業日以内に担当者よりご連絡差し上げます。
        </p>
    </div>
</body>
</html>
