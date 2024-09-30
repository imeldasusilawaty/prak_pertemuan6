<?php

if (isset($_POST["submit"])) {
    // Folder tempat menyimpan file
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Periksa apakah file diupload
    if ($_FILES["gambar"]["error"] == UPLOAD_ERR_OK) {
        // Periksa apakah file adalah gambar asli atau bukan
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            echo "File adalah gambar - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        // Periksa apakah file sudah ada
        if (file_exists($target_file)) {
            echo "Maaf, file sudah ada.";
            $uploadOk = 0;
        }

        // Periksa ukuran file
        if ($_FILES["gambar"]["size"] > 500000) {
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        // Perbolehkan hanya format tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
            $uploadOk = 0;
        }

        // Jika $uploadOk tidak sama dengan 0, maka upload file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                echo "<script>alert('File " . htmlspecialchars(basename($_FILES["gambar"]["name"])) . " berhasil diupload.'); window.location.href='upload_form.html';</script>";
            } else {
                echo "Maaf, terjadi kesalahan saat mengupload file.";
            }
        }
    } else {
        echo "<script>alert('Data tidak boleh kosong. Silakan pilih gambar untuk diupload.'); window.location.href='upload_form.html';</script>";
    }
}
