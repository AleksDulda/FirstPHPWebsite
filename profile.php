<?php
session_start();

// Veritabanına bağlanıldı
$mysqli = mysqli_connect("localhost", "dbusr21360859025", "yNzyu1olIp4L", "dbstorage21360859025");

// Kullanıcı bilgilerini sorgula
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($mysqli, $query);

    // Kullanıcı bilgilerini al
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $firstname = $user['firstname'];
        $lastname = $user['lastname'];
        $phonenumber = $user['phonenumber'];
        $email = $user['email'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>

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
                    <h1 class="text-center">Kullanıcı Profili</h1>
                </div>
                <div class="card-body">
                    <div class="content">
                        <?php if (isset($_SESSION['username'])): ?>
                            <p><strong>Ad:</strong> <?php echo $firstname; ?></p>
                            <p><strong>Soyad:</strong> <?php echo $lastname; ?></p>
                            <p><strong>GSM:</strong> <?php echo $phonenumber; ?></p>
                            <p><strong>E-posta:</strong> <?php echo $email; ?></p>
                        <?php else: ?>
                            <p>Lütfen giriş yapın.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>

