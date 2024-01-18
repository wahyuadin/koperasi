<?php
if (isset($_POST['unggah'])) {
    $targetDir = "assets/gambar/";
    $targetFile = $targetDir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Periksa apakah file adalah gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check == false) {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Periksa ekstensi file
    if ($imageFileType != "jpg" && $imageFileType != "png") {
        echo "Maaf, hanya file JPG dan PNG yang diizinkan.";
        $uploadOk = 0;
    }

    // Periksa apakah file sudah ada
    if (file_exists($targetFile)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Periksa ukuran file
    if ($_FILES["gambar"]["size"] > 1000000) {
        echo "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Jika semua kondisi terpenuhi, unggah file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
            echo "File " . basename($_FILES["gambar"]["name"]) . " berhasil diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Maaf, file tidak diunggah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Upload Gambar</title>
</head>
<body>

<h2>Upload Gambar</h2>

<form action="" method="post" enctype="multipart/form-data">
    <label for="gambar">Pilih Gambar (PNG/JPG):</label>
    <input type="file" id="gambar" name="gambar" accept=".png, .jpg">
    <br>
    <button type="submit" name="unggah">Unggah</button>
</form>

</body>
</html>

