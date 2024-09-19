<?php
header('Content-Type: application/json');

// データベース接続設定
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prost";

// データベース接続の作成
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続の確認
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'データベース接続エラー: ' . $conn->connect_error]);
    exit;
}

// POSTデータの取得
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => '無効なデータ']);
    exit;
}

$name = $data['name'];
$age = $data['age'];
$phone = $data['phone'];
$coupon = $data['coupon'];

// SQLクエリの作成と実行
$sql = "INSERT INTO userdata (phone, name, coupon, age) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'SQL準備エラー: ' . $conn->error]);
    exit;
}

$stmt->bind_param("sssi", $phone, $name, $coupon, $age);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'データベースへの挿入エラー: ' . $stmt->error]);
}

// 接続のクローズ
$stmt->close();
$conn->close();
?>
