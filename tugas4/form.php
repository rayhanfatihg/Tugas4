<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea, select, button {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
        }
        .error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1>Form Pendaftaran</h1>
    <form id="registrationForm" action="process.php" method="POST" enctype="multipart/form-data">
        <label for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" required>
        <div class="error" id="nameError"></div>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <div class="error" id="emailError"></div>

        <label for="age">Usia</label>
        <input type="number" id="age" name="age" min="10" max="100" required>
        <div class="error" id="ageError"></div>

        <label for="resume">Unggah File (Teks)</label>
        <input type="file" id="resume" name="resume" accept=".txt" required>
        <div class="error" id="resumeError"></div>

        <label for="bio">Biodata Singkat</label>
        <textarea id="bio" name="bio" rows="5" required></textarea>
        <div class="error" id="bioError"></div>

        <button type="submit">Kirim</button>
    </form>

    <script>
        document.getElementById("registrationForm").addEventListener("submit", function (e) {
            let hasError = false;

            const name = document.getElementById("name").value.trim();
            if (name.length < 3) {
                document.getElementById("nameError").textContent = "Nama harus lebih dari 3 karakter.";
                hasError = true;
            } else {
                document.getElementById("nameError").textContent = "";
            }

            const resume = document.getElementById("resume").files[0];
            if (resume && resume.size > 1024 * 1024) { // 1MB max size
                document.getElementById("resumeError").textContent = "Ukuran file tidak boleh lebih dari 1MB.";
                hasError = true;
            } else {
                document.getElementById("resumeError").textContent = "";
            }

            if (hasError) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
