<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $age = (int)$_POST['age'];
    $bio = trim($_POST['bio']);

    // Validasi data
    $errors = [];
    if (strlen($name) < 3) {
        $errors[] = "Nama harus lebih dari 3 karakter.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }
    if ($age < 10 || $age > 100) {
        $errors[] = "Usia harus antara 10-100.";
    }

    // Validasi file
    $fileContent = "";
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['resume'];
        if ($file['size'] > 1024 * 1024) { // 1MB max size
            $errors[] = "Ukuran file tidak boleh lebih dari 1MB.";
        }
        $fileType = mime_content_type($file['tmp_name']);
        if ($fileType !== 'text/plain') {
            $errors[] = "Hanya file teks (.txt) yang diizinkan.";
        } else {
            $fileContent = file_get_contents($file['tmp_name']);
        }
    } else {
        $errors[] = "File tidak diunggah atau terjadi kesalahan.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<a href='form.php'>Kembali</a>";
        exit;
    }

    // Mendapatkan info browser dan OS
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    // Simpan data ke session
    session_start();
    $_SESSION['formData'] = compact('name', 'email', 'age', 'bio', 'fileContent', 'userAgent');

    header('Location: result.php');
    exit;
}
?>
