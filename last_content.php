<?php
$servername = "localhost"; // Sunucu adı
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifre
$dbname = "96tr_db"; // Veritabanı adı

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$sql = "SELECT * FROM bonus";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Bonus ID</th><th>Üye ID</th><th>Bonus Adı</th><th>Bonus Durumu</th><th>İşlemler</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["bonus_name"] . "</td>";
        echo "<td>" . $row["bonus_status"] . "</td>";
        echo "<td>";
        echo "<button onclick='openPopup(" . $row["id"] . ")'>İşleme Al</button>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Veritabanında bonus bulunamadı.";
}

$conn->close();
?>
