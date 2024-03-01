<?php
// Veritabanı bağlantı bilgileri
$servername = "localhost"; // Sunucu adı
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifre
$dbname = "96tr_db"; // Veritabanı adı

// POST verilerini al
$userID = $_POST['user_id'];
$bonusName = $_POST['bonus_name'];
$bonusStatus = $_POST['bonus_status'];

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// SQL sorgusu
$sql = "INSERT INTO bonus (user_id, bonus_name, bonus_status, bonus_aciklama) VALUES ('$userID', '$bonusName', '$bonusStatus', 'Talebiniz işlem sırasındadır en kısa sürede bonusunuz tanımlanacaktır')";

// Sorguyu çalıştır ve başarı kontrolü
if ($conn->query($sql) === TRUE) {
    echo "Bonus talebi başarıyla eklendi.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
