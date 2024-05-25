<?php
session_start();

// Veritabanı bağlantısı
$mysqli = mysqli_connect("localhost", "dbusr21360859025", "yNzyu1olIp4L", "dbstorage21360859025");

// oturum kontrolü
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

//form verilerini al
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslik = $_POST['baslik'];
    $degerlendirme = $_POST['degerlendirme'];
    $puanlama = $_POST['puanlama'];

    // Kullanıcının ID'sini al
    $username = $_SESSION['username'];
    $user_query = "SELECT ID FROM users WHERE username = '$username'";
    $user_result = mysqli_query($mysqli, $user_query);
    $user_row = mysqli_fetch_assoc($user_result);
    $users_ID = $user_row['ID'];

   
    $olusturmatarihi = date("Y-m-d H:i:s");

    //verileri veritabanına ekle
    $insert_query = "INSERT INTO reviews (users_ID, baslik, degerlendirme, puanlama, olusturmatarihi) VALUES ('$users_ID', '$baslik', '$degerlendirme', '$puanlama', '$olusturmatarihi')";
    $insert_result = mysqli_query($mysqli, $insert_query);

    if ($insert_result) {
        echo "Değerlendirme başarıyla eklendi.";
        header("Location: index.php ");
    } else {
        echo "Hata: " . mysqli_error($mysqli);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Değerlendirme Formu</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar1 {
            background-color: #333;
            overflow: hidden;
        }
        .navbar1 a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .navbar1 a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar1 .right {
            float: right;
        }
    </style>
</head>



<body>

    <!-- Navbar -->
 <div class="navbar1">
        <a href="index.php">Anasayfa</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="profile.php" >Profil</a>
            <a href="reviews.php" >Degerlendir</a>
            <a href="view_reviews.php" >Degerlendirme görüntüle</a>

            <a href="logout.php" class="right">Çıkış Yap</a>
        <?php else: ?>
            <a href="kayit.php" class="right">Kayıt Ol</a>
            <a href="giris.php" class="right">Giriş Yap</a>
        <?php endif; ?>
    </div>

    

    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">BTÜ Filmi Değerlendirme Formu</h2>
                </div>
                <div class="card-body">
                    <form action="reviews.php" method="post">
                        <div class="form-group">
                            <label for="baslik">Değerlendirme Başlığı:</label>
                            <input type="text" id="baslik" name="baslik" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="degerlendirme">Değerlendirme:</label>
                            <textarea id="degerlendirme" name="degerlendirme" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="puanlama">Puanlama (1-10 arası):</label>
                            <input type="number" id="puanlama" name="puanlama" class="form-control" min="1" max="10" required>
                        </div>
                        <div class="text-center"><br>
                            <button type="submit" class="btn btn-primary">Değerlendir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
