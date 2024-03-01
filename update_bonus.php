<?php

$servername = "localhost"; // Sunucu adı
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifre
$dbname = "96tr_db"; // Veritabanı adı


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}


$userId = $_POST['userId'];
$action = $_POST['action'];
$comment = $_POST['comment'];

$sql = "UPDATE bonus SET bonus_status = ?, bonus_aciklama = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Hata: " . $conn->error);
}

$stmt->bind_param("ssi", $action, $comment, $userId);

if ($stmt->execute()) {
    echo "Bonus başarıyla güncellendi.";
} else {
    echo "Bonus güncellenirken bir hata oluştu.";
}

$stmt->close();
$conn->close();
?>
