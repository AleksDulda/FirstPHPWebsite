<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Formu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .container {
            height: 100vh;
        }

        #kayitform {
            max-width: 400px;
            width: 100%;
        }
    </style>
 
</head>

<body style="background-color: lightgray;">
    <div class="container d-flex justify-content-center align-items-center">
        <form id="kayitform" action="kayit.php" method="post" class="p-4 border rounded-3" style="background-color: white;" onsubmit="return validateForm();">
            <h3 class="text-center mb-4">Kayıt Ol</h3>
            <div class="mb-3">
                <label for="username" class="form-label">Kullanıcı Adı:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">Ad:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Soyad:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="phonenumber" class="form-label">GSM:</label>
                <input type="tel" class="form-control" id="phonenumber" name="phonenumber" maxlength="11" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-posta:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="passwordd" class="form-label">Şifre:</label>
                <input type="password" class="form-control" id="passwordd" name="passwordd" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Kayıt Ol</button>
        </form>
    </div>
</body>

</html>


</body>

</html>

<?php
// Veritabanına bağlanıldı
$mysqli = mysqli_connect("localhost", "dbusr21360859025", "yNzyu1olIp4L", "dbstorage21360859025");

// POST isteğiyle form verilerini alındı
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verileri alındı
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = $_POST['passwordd'];

    // Şifre Hashlandı
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Kullanıcı adının, GSM numarasının ve e-posta adresinin uniqe olup olmadığı kontrol edildi
    $check_query_phone = "SELECT * FROM users WHERE phonenumber = '$phonenumber'";
    $check_result_phone = mysqli_query($mysqli, $check_query_phone);
    $check_query_email = "SELECT * FROM users WHERE email = '$email'";
    $check_result_email = mysqli_query($mysqli, $check_query_email);
    $check_query_username = "SELECT * FROM users WHERE username = '$username'";
    $check_result_username = mysqli_query($mysqli, $check_query_username);

    // Hata mesajlarını oluştur ve alert olarak göster
    if (mysqli_num_rows($check_result_username) > 0) {
        echo '<script>alert("Bu kullanıcı adı zaten kullanılıyor. Lütfen farklı bir kullanıcı adı seçin.");</script>';
    } elseif (mysqli_num_rows($check_result_phone) > 0) {
        echo '<script>alert("Bu GSM numarası zaten kullanılıyor. Lütfen farklı bir GSM numarası girin.");</script>';
    } elseif (mysqli_num_rows($check_result_email) > 0) {
        echo '<script>alert("Bu e-posta adresi zaten kullanılıyor. Lütfen farklı bir e-posta adresi girin.");</script>';
    } else {
        // Veritabanına yeni bir kayıt eklendi
        $query = "INSERT INTO users (username, firstname, lastname, phonenumber, email, passwordd) VALUES ('$username', '$firstname', '$lastname', '$phonenumber', '$email', '$hashed_password')";
        $result = mysqli_query($mysqli, $query);

        // Ekleme başarılı olup olmadığı kontrol edildi
        if ($result) {
            echo '<script>alert("Kullanıcı Başarıyla Kayıt edildi.");</script>';
            header("Location: index.php");
            exit(); // Kodun burada sonlandığına emin olmak için exit() fonksiyonunu kullanıyoruz.
        } else {
            echo "Hata: " . mysqli_error($mysqli);
        }
    }
}

// Bağlantı kapatıldı
mysqli_close($mysqli);
?>
