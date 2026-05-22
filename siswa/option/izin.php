<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today Attendance</title>
    <link rel="stylesheet" href="./../css/izin.css">
</head>
<body>
    <div class="permit">
        <div class="permit-header">
            <h1>Upload Surat Izin</h1>
        </div>
        <div class="manual-input">
            <label for="manualFile">Pilih File Surat</label>
            <input type="file" id="manualFile" accept="image/*" />
            <button id="manualSubmit">Kirim File</button>
        </div>
        <button class="back-button" onclick="window.location.href='../siswa.php?page=attd'">Kembali</button>
    </div>
</body>
</html>