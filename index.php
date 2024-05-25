<?php
session_start();

$servername = "localhost"; 
$username = "dbusr21360859025"; 
$password = "yNzyu1olIp4L"; 
$dbname = "dbstorage21360859025"; 



$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Reviews tablosundan verileri çekimi username aktarımı
$sql = "SELECT reviews.baslik, reviews.degerlendirme, reviews.puanlama, reviews.olusturmatarihi, users.username 
        FROM reviews 
        JOIN users ON reviews.users_ID = users.ID 
        ORDER BY reviews.olusturmatarihi DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anasayfa</title>
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
<body style="background-color: lightgray;">


<!--Navbar -->
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
<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
       Github Sayfasına Gitmek İçin...
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <p>Github Link:  <a href="https://github.com/AleksDulda/FirstPHPwebsite">https://github.com/AleksDulda/FirstPHPwebsite</a><p>
        <p>Website Tanıtım Link:  <a href="https://www.youtube.com/watch?v=6WTjLSqeBX8">https://www.youtube.com/watch?v=6WTjLSqeBX8</a><p>
       
       </div>
    </div>
  </div>
  <br>

<br>
<div style="text-align: center;" ><h2>BTÜ TANITIM FİLMi DEĞERLENDİRME SAYFASINA HOŞ GELDİNİZ</h2></div><BR></BR>
<div style="text-align: center;">
<h1></h1>
    <video width="640" height="360" controls >
        <source src="./BTU.mp4" type="video/mp4">
        Tarayıcınız video etiketini desteklemiyor.
    </video>
</div>

<br><H3 style="padding-left: 50px;">Değerlendirmeler: </H3>
<div class="container mt-5">
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title"><strong><?php echo $row['baslik']; ?></strong></h3>
                            <p class="card-text"><strong>Puanlama:</strong> <?php echo $row['puanlama']; ?></p>
                            <p class="card-text"><?php echo $row['degerlendirme']; ?></p><br><br>
                           
                            <p class="card-text"><strong>Kullanıcı:</strong> <?php echo $row['username']; ?></p>
                            <p class="card-text"><small class="text-muted"><?php echo date('d.m.Y', strtotime($row['olusturmatarihi'])); ?></small></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Henüz değerlendirme yok.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
