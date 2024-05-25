<?php
session_start();

// Veritabanı bağlantısı
$mysqli = mysqli_connect("localhost", "dbusr21360859025", "yNzyu1olIp4L", "dbstorage21360859025");

//oturumu kontrol et
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

// Kullanıcının ID'sini al
$username = $_SESSION['username'];
$user_query = "SELECT ID FROM users WHERE username = '$username'";
$user_result = mysqli_query($mysqli, $user_query);
$user_row = mysqli_fetch_assoc($user_result);
$users_ID = $user_row['ID'];

//değerlendirmeleri sorgula
$query = "SELECT * FROM reviews WHERE users_ID = '$users_ID'";
$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kendi Değerlendirmelerim</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            word-wrap: break-word;
            max-width: 200px; 
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="navbar1">
    <a href="index.php">Anasayfa</a>
    <?php if (isset($_SESSION['username'])): ?>
        <a href="profile.php">Profil</a>
        <a href="reviews.php">Degerlendir</a>
        <a href="view_reviews.php">Degerlendirme görüntüle</a>
        <a href="logout.php" class="right">Çıkış Yap</a>
    <?php else: ?>
        <a href="kayit.php" class="right">Kayıt Ol</a>
        <a href="giris.php" class="right">Giriş Yap</a>
    <?php endif; ?>
</div>
<br><br>
<div class="container">
    <h2>Kendi Değerlendirmelerim</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Başlık</th>
                <th scope="col">Değerlendirme</th>
                <th scope="col">Puanlama</th>
                <th scope="col">Oluşturulma Tarihi</th>
                <th scope="col">İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['baslik']); ?></td>
                    <td><?php echo htmlspecialchars($row['degerlendirme']); ?></td>
                    <td><?php echo htmlspecialchars($row['puanlama']); ?></td>
                    <td><?php echo htmlspecialchars($row['olusturmatarihi']); ?></td>
                    <td>
                        <a href="gonderim_duzenle.php?id=<?php echo $row['ID']; ?>" class="btn btn-primary">Düzenle</a>
                        <a href="delete_review.php?id=<?php echo $row['ID']; ?>" class="btn btn-danger" onclick="return confirm('Bu değerlendirmeyi silmek istediğinizden emin misiniz?');">Sil</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
