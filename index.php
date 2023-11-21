<!DOCTYPE html>
<html>
<head>
    <title>Web Sitesi Arşiv Alma Aracı</title>
</head>
<body>
    <form method="post" style="width: 500px; margin: auto;">
        <h1>Web Sitesi Arşiv Alma Aracı</h1>
        <label>Web sitesini arşiv almak için URL girin:</label><br>
        <input type="text" name="url" placeholder="http://www.example.com/" style="width: 100%;" /><br>
        <input type="submit" name="submit" value="Arşiv Al" style="width: 100%; margin-top: 10px; padding: 10px; background-color: #333; color: #fff; font-weight: bold;" />
    </form>

    <?php
   
/**
 * @author github.com/urf54
 */


// Kayıt dosyalarının bulunduğu dizini al
$dir = "./";

// Kayıt dosyalarını al
$files = scandir($dir);

// Kayıt dosyalarını filtrele ve sadece HTML dosyalarını al
$htmlFiles = array_filter($files, function($file) {
    return strpos($file, ".html") !== false;
});

	
	// Eğer form gönderilmişse
    if (isset($_POST["submit"])) {
        // Web sitesini arşiv almak için kullanılacak URL'yi alın
        $url = $_POST["url"];

        // URL'den dosya ismini oluştur
        $fileName = md5(uniqid()) . ".html";


        // Web sitesinin indirilme tarihini oluştur
        $date = date("d.m.Y H:i:s");

        // Headar kısmına bilgi yazısını ekleyecek kodu oluştur
        $header = "<!-- Arşiv alındı: " . $date . " -->\n";
        $header .= "<p>Bu arşiv ufyazilim sitesinden alınmıştır.</p>\n";


        // Web sitesini indir
        $html = file_get_contents($url);

        // Eğer web sitesi indirilemediyse hata mesajı göster
        if (empty($html)) {
            echo "<p style='color: red; margin-top: 10px;'>Web sitesi indirilemedi! Lütfen URL'yi kontrol edin.</p>";
        }
        // Web sitesi indirilebildiyse dosyaya kaydet
        else {
            // Indirilen web sitesini bir dosyaya yazın
            file_put_contents($fileName, $header . $html);

            // Arşiv dosyasına giden linki ekrana yazdır
            echo "<p style='margin-top: 10px;'><a href='" . $fileName . "'>Arşiv dosyasına giden link</a></p>";
        }
    }
    ?>
<h2>Kayıt Dosyaları</h2>
<ul>
<?php foreach ($htmlFiles as $file): ?>
    <li><a href="<?php echo $file; ?>"><?php echo $file; ?></a></li>
<?php endforeach; ?>
</ul>
	
	</body>
</html>


