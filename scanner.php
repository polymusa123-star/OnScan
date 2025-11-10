<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="scan.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
   
</head>
<body>
    <div class="main">
        <input type="checkbox" id="tap">
        <label for="tap" class="btn" >=</label>
        <div class="menu-btn">
            <a href="index.php">home</a>
            <a href="scanner.php">scanner</a>
            <a href="login.php">QR generator</a>
            <a href="file.php">record</a>
        </div>

 <div id="preview" class="cam"></div>
    <p id="result"></p>

  <script src="html5-qrcode.min.js"></script>
  <script>
    const result = document.getElementById('result');
    const scanner = new Html5Qrcode("preview");

        let lastScanTime = 0;

    function onScanSuccess(decodedText) {
        const now = Date.now();

        if( now - lastScanTime < 3000){
          return;
        }

      lastScanTime = now ;
      result.textContent = "Scanned: " + decodedText;

      const formData = new FormData();
      formData.append('qr_text', decodedText);

      fetch('scans.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.text())
      .then(data => {
        console.log(data);
        alert(data);
      })
      .catch(err => console.error(err));
    }

    scanner.start(
      { facingMode: "environment" },
      { fps: 10, qrbox: 250 },
      onScanSuccess
    );

    
</script>
</body>
</html>