<?php
session_start();

// Veritabanı bağlantısı
$mysqli = mysqli_connect("localhost", "dbusr21360859025", "yNzyu1olIp4L", "dbstorage21360859025");


// Kullanıcının oturumunu kontrol et
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

// POST isteği ile düzenlenen değerlendirmeyi güncelle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $review_id = $_POST['review_id'];
    $baslik = $_POST['baslik'];
    $degerlendirme = $_POST['degerlendirme'];
    $puanlama = $_POST['puanlama'];

    // Kullanıcının ID'sini al
    $username = $_SESSION['username'];
    $user_query = "SELECT ID FROM users WHERE username = '$username'";
    $user_result = mysqli_query($mysqli, $user_query);
    $user_row = mysqli_fetch_assoc($user_result);
    $users_ID = $user_row['ID'];

    // Değerlendirme bilgilerini güncelle
    $update_query = "UPDATE reviews SET baslik = '$baslik', degerlendirme = '$degerlendirme', puanlama = '$puanlama' WHERE ID = '$review_id' AND users_ID = '$users_ID'";
    $update_result = mysqli_query($mysqli, $update_query);

    if ($update_result) {
        echo "Değerlendirme başarıyla güncellendi.";
    } else {
        echo "Hata: " . mysqli_error($mysqli);
    }
}

// Düzenlenecek değerlendirmenin ID'sini al
if (isset($_GET['id'])) {
    $review_id = $_GET['id'];

    // Düzenlenecek değerlendirmenin verilerini al
    $username = $_SESSION['username'];
    $user_query = "SELECT ID FROM users WHERE username = '$username'";
    $user_result = mysqli_query($mysqli, $user_query);
    $user_row = mysqli_fetch_assoc($user_result);
    $users_ID = $user_row['ID'];

    $query = "SELECT * FROM reviews WHERE ID = '$review_id' AND users_ID = '$users_ID'";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: view_reviews.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Değerlendirme Düzenle</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Değerlendirme Düzenle</h2>
                </div>
                <div class="card-body">
                    <form action="gonderim_duzenle.php" method="post">
                        <input type="hidden" name="review_id" value="<?php echo $row['ID']; ?>">
                        <div class="form-group">
                            <label for="baslik">Başlık:</label>
                            <input type="text" id="baslik" name="baslik" class="form-control" value="<?php echo $row['baslik']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="degerlendirme">Değerlendirme:</label>
                            <textarea id="degerlendirme" name="degerlendirme" class="form-control" rows="4" required><?php echo $row['degerlendirme']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="puanlama">Puanlama (1-10 arası):</label>
                            <input type="number" id="puanlama" name="puanlama" class="form-control" min="1" max="10" value="<?php echo $row['puanlama']; ?>" required>
                        </div>
                        <div class="text-center"><br>
                            <button type="submit" class="btn btn-success">Güncelle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
