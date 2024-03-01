<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Veritabanı bağlantı bilgileri
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "96tr_db";

    // Veritabanına bağlan
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantı hatası kontrolü
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // GET verilerini al
    $user_id = $_GET["user_id"];

    // SQL sorgusu
    $sql = "SELECT id, bonus_name, bonus_status, bonus_aciklama FROM bonus WHERE user_id = ? ORDER BY id DESC LIMIT 1";

    // Hazırlanan ifadeyi kullanarak sorguyu çalıştır
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    // SQL sorgusunu çalıştır ve sonucu kontrol et
    if ($stmt->execute()) {
        // Sonuç setini al
        $result = $stmt->get_result();

        // Sonuçları bir dizi olarak al
        $bonusInfo = $result->fetch_assoc();

        // Bonus bilgilerini JSON formatında döndür
        echo json_encode($bonusInfo);
    } else {
        echo json_encode(null); // Belirtilen üye ID ile ilgili bonus bilgisi bulunamadı
    }

    // Bağlantıyı kapat
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(null); // Geçersiz istek
}
?>
