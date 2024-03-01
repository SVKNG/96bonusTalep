<?php

$servername = "localhost"; // Sunucu adı
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifre
$dbname = "96tr_db"; // Veritabanı adı

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// POST verilerini al
$userId = $_POST['userId'];
$action = $_POST['action'];
$comment = $_POST['comment'];

// SQL sorgusu
$sql = "UPDATE bonus SET bonus_status = ?, bonus_aciklama = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

// Hazırlanan ifade kontrolü
if (!$stmt) {
    die("Hata: " . $conn->error);
}

// Bağlantıyı hazırla ve parametreleri bağla
$stmt->bind_param("ssi", $action, $comment, $userId);

// Sorguyu çalıştır ve güncelleme başarı kontrolü
if ($stmt->execute()) {
    echo "Bonus başarıyla güncellendi.";
} else {
    echo "Bonus güncellenirken bir hata oluştu.";
}

// Bağlantıyı kapat
$stmt->close();
$conn->close();
?>
