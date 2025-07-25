<?php
// DB接続設定
define('DB_SERVER', 'tcp:24yn0108db.database.windows.net,1433');
define('DB_DATABASE', '24yn0108'); // ← データベース名
define('DB_USER', '24yn0108');
define('DB_PASSWORD', 'Pa$$word1234'); // ← 正しいパスワードを設定

// 接続処理
$connectionOptions = array(
    "Database" => DB_DATABASE,
    "Uid" => DB_USER,
    "PWD" => DB_PASSWORD,
    "Encrypt" => true,
    "TrustServerCertificate" => false
);

$conn = sqlsrv_connect(DB_SERVER, $connectionOptions);

// 接続チェック
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
