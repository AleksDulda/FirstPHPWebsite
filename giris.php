<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<body style="background-color: lightgrey;">
<style>
        .container {
            height: 100vh; 
        }
        #girisform {
            max-width: 400px; 
            width: 100%;
        }
    </style>
<!-- Giriş Formu -->


<div class="container d-flex justify-content-center align-items-center" >

        <form id="girisform" action="giris.php" method="post" class="p-4 border rounded-3" style="background-color: white;">
        <h3 class="text-center mb-4">Giriş Yap</h3>    
        <div class="mb-3">
                <label for="username" class="form-label">Kullanıcı Adı:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="passwordd" class="form-label">Şifre:</label>
                <input type="password" class="form-control" id="passwordd" name="passwordd" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
        </form>
</div>



</body>
</html>
<?php
session_start();
// Veritabanına bağlanıldı
$mysqli = mysqli_connect("localhost", "dbusr21360859025", "yNzyu1olIp4L", "dbstorage21360859025");


//  veriler alındı
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['passwordd'];

    // Kullanıcı adıyla eşleşen kayıtların sorgusu
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($mysqli, $query);

    // Kullanıcı var mı kontrol edildi
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Şifre doğrulandı
        if (password_verify($password, $user['passwordd'])) {
            // Oturum başlatma
            $_SESSION['username'] = $username;
            echo "Giriş başarılı! Hoş geldiniz, " . $user['firstname'] . " " . $user['lastname'] . ".";
            // Kullanıcıyı anasayfaya yönlendir
            header("Location: index.php");
            exit();
        } else {
            echo '<script>alert("Hatalı şifre girdiniz!");</script>';
            
        }
    } else {
        
        echo '<script>alert("Bu kullanıcı adıyla bir kayıt bulunamadı.");</script>';
    }
}

// Bağlantı kapatıldı.
mysqli_close($mysqli);
?>
