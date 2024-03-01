<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Bonus Yönetim Paneli</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
            z-index: 1;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }
    </style>

</head>
<body>

    <h1>Bonus Yönetim Paneli</h1>
<div id="bonusTable">
    <?php 
        $servername = "localhost"; // Sunucu adı
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifre
$dbname = "96tr_db"; // Veritabanı adı


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
     ?>
</div>

<div id="popup" class="popup">
    <h2>Açıklama Girin</h2>
    <textarea id="comment" rows="4" cols="50"></textarea>
    <br>
    <button onclick="updateBonusStatus('Onaylandı')">Onayla</button>
    <button onclick="updateBonusStatus('Reddedildi')">Reddet</button>
    <button onclick="updateBonusStatus('İşleme Alındı')">İşleme Al</button>
    <button onclick="closePopup()">Kapat</button>
</div>

<div id="overlay" class="overlay" onclick="closePopup()"></div>


<script>
    // Sayfa yüklendiğinde ve belirli aralıklarla otomatik güncelleme işlemi
    $(document).ready(function() {
       
        updateTable();

        setInterval(function() {
            updateTable();
        }, 5000); 
    });

    function updateTable() {
        $.ajax({
            url: 'last_content.php',
            type: 'GET',
            success: function(response) {
               
                $('#bonusTable').html(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function openPopup(userId) {
        document.getElementById("popup").style.display = "block";
        document.getElementById("comment").dataset.userId = userId;
    }

    function closePopup() {
        document.getElementById("popup").style.display = "none";
        document.getElementById("comment").value = "";
    }

    function updateBonusStatus(action) {
        var userId = document.getElementById("comment").dataset.userId;
        var comment = document.getElementById("comment").value;

        $.ajax({
            url: 'update_bonus.php',
            type: 'POST',
            data: {
                userId: userId,
                action: action,
                comment: comment
            },
            success: function(response) {
                console.log(response);
                // Güncelleme başarılıysa, tabloyu güncelle
                updateTable();
                closePopup();
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>
</body>
</html>
