<?php
session_start();

// Veritabanı bağlantısı
$mysqli = mysqli_connect("localhost", "dbusr21360859025", "yNzyu1olIp4L", "dbstorage21360859025");

//  oturum kontrol et
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

// Değerlendirme ID'sini al
if (isset($_GET['id'])) {
    $review_id = $_GET['id'];

    // Kullanıcının ID'sini al
    $username = $_SESSION['username'];
    $user_query = "SELECT ID FROM users WHERE username = '$username'";
    $user_result = mysqli_query($mysqli, $user_query);
    $user_row = mysqli_fetch_assoc($user_result);
    $users_ID = $user_row['ID'];

    // Değerlendirmeyi sil
    $delete_query = "DELETE FROM reviews WHERE ID = '$review_id' AND users_ID = '$users_ID'";
    $delete_result = mysqli_query($mysqli, $delete_query);

    if ($delete_result) {
  
        echo '<script>alert("Değerlendirme başarıyla silindi.");</script>';
  
        header("Location: view_reviews.php ");

    } else {
        echo "Hata: " . mysqli_error($mysqli);
    }
} else {
    echo "Geçersiz değerlendirme ID'si.";
}
?>
