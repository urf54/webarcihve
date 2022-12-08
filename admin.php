<!DOCTYPE html>
<html>
<head>
    <title>Web Sitesi Arşiv Yönetim Paneli</title>
</head>
<body>
    <h1>Web Sitesi Arşiv Yönetim Paneli</h1>

    <h2>Mevcut Arşiv Dosyaları</h2>
    <ul>
        <?php
      // Güvenlik için kullanılacak şifreyi tanımlayın
$password = "mypassword";

// Eğer giriş formu gönderilmişse
if (isset($_POST["login"])) {
    // Girilen şifreyi al
    $enteredPassword = $_POST["password"];

    // Eğer girilen şifre doğruysa
    if ($enteredPassword == $password) {
        // Oturumu başlat
        session_start();

        // Giriş yapıldığını belirten bir değişken oluştur
        $_SESSION["loggedIn"] = true;
    } else {
        // Hata mesajı göster
        echo "<p style='color: red; margin-top: 10px;'>Şifre yanlış! Lütfen tekrar deneyin.</p>";
    }
}

// Eğer oturum açılmışsa
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
    // Yönetim panelini göster
    // ...
} else {
    // Giriş formunu göster
    echo "<form action='admin.php' method='post'>";
    echo "<input type='password' name='password' placeholder='Şifre' required>";
    echo "<input type='submit' name='login' value='Giriş Yap'>";
    echo "</form>";
}

		
		// Eğer dosya silme formu gönderilmişse
        if (isset($_POST["delete"])) {
            // Silinecek dosya adını al
            $fileName = $_POST["fileName"];

            // Dosyayı sil
            unlink($fileName);

            // Dosya silindiğini bildir
            echo "<p style='color: green; margin-top: 10px;'>Dosya silindi!</p>";
        }

        // Mevcut dosyaları listele
        $files = glob("*.html");
        foreach ($files as $file) {
            // Her dosya için bir link oluştur
            $link = "<li><a href='" . $file . "' target='_blank'>" . $file . "</a>";

            // Her dosya için silme formunu oluştur
            $form = "<form method='post' style='display: inline-block; margin-left: 10px;'>";
            $form .= "<input type='hidden' name='fileName' value='" . $file . "' />";
            $form .= "<input type='submit' name='delete' value='Sil' style='padding: 5px; background-color: red; color: #fff; font-weight: bold;' />";
            $form .= "</form></li>";

            // Linki ve formu ekrana yaz
            echo $link . $form;
        }
  
		?>
    </ul>
</body>
</html>
