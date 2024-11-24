<?php
session_start();
if (!isset($_SESSION['formData'])) {
    echo "Data tidak ditemukan. <a href='form.php'>Isi formulir lagi.</a>";
    exit;
}
$data = $_SESSION['formData'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran</title>
</head>
<body>
    <h1>Hasil Pendaftaran</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>Nama Lengkap</th>
            <td><?= htmlspecialchars($data['name']) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= htmlspecialchars($data['email']) ?></td>
        </tr>
        <tr>
            <th>Usia</th>
            <td><?= htmlspecialchars($data['age']) ?></td>
        </tr>
        <tr>
            <th>Biodata</th>
            <td><?= nl2br(htmlspecialchars($data['bio'])) ?></td>
        </tr>
        <tr>
            <th>Isi File (harus txt ya)</th>
            <td><pre><?= htmlspecialchars($data['fileContent']) ?></pre></td>
        </tr>
        <tr>
            <th>Browser/OS</th>
            <td><?= htmlspecialchars($data['userAgent']) ?></td>
        </tr>
    </table>
</body>
</html>
