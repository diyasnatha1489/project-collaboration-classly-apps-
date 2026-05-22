<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <link rel="stylesheet" href="./../../css/s.css">
    <script src="https://unpkg.com/html5-qrcode"></script>
</head> 
<body>
    <div class="scanner-page">
        <div class="scanner-header">
            <h1>Scan QR Code</h1>
            <p>Gunakan kamera atau pilih gambar QR untuk memindai.</p>
        </div>
        <div class="scan-box" id="scan">
            <div class="scan-label">Scan-box</div>
        </div>

        <!-- <div class="manual-input">
            <label for="manualFile">Pilih gambar QR</label>
            <input type="file" id="manualFile" accept="image/*" />
            <button id="manualSubmit">Scan File</button>
        </div> -->

        <button class="back-button" onclick="window.location.href='../siswa.php?page=attd'">Kembali</button>
    </div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            alert("Berhasil Scan: " + decodedText);
            window.location.href = "../siswa.php?page=attd&kode=" + encodeURIComponent(decodedText);
        }

        function onScanFailure(error) {
            console.warn(error);
        }

        const html5QrCode = new Html5Qrcode('scan');
        const config = { fps: 10, qrbox: 250 };
        let cameraStarted = false;
        let cameraDevices = [];

        function setPreviewMirror(cameraId) {
            const camera = cameraDevices.find(cam => cam.id === cameraId);
            const video = document.querySelector('#scan video');
            if (!video) return;
            const isFront = camera && /front|selfie|user/i.test(camera.label);
            video.style.transform = isFront ? 'scaleX(-1)' : 'none';
        }

        Html5Qrcode.getCameras().then(cameras => {
            if (cameras && cameras.length) {
                cameraDevices = cameras;
                const backCamera = cameras.find(cam => /rear|back|environment/i.test(cam.label));
                const cameraId = backCamera ? backCamera.id : cameras[0].id;

                html5QrCode.start(cameraId, config, onScanSuccess, onScanFailure)
                    .then(() => {
                        cameraStarted = true;
                        setTimeout(() => setPreviewMirror(cameraId), 200);
                    })
                    .catch(err => {
                        console.warn('Camera start failed:', err);
                    });
            }
        }).catch(err => {
            console.warn('Get cameras failed:', err);
        });
    </script>
</body>
</html>
