<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="sheet.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
   
    <div id="time" class="time"></div>
    <div id="date"></div>
    <div class="menu">
        <a  class="but1" href="file.php"><img src="pic\Screenshot 2025-10-31 135821.png" alt=""></a>
        <a class="but2" href="scanner.php"><img src="pic\Screenshot 2025-10-31 142603.png" alt=""></a>
        <a class="but3"  href="login.php"><img src="pic\Screenshot 2025-10-31 135432.png" alt=""></a>
    </div>
    <script src="date-time.js"></script>

    <script>
function updateBackground() {
  const hour = new Date().getHours(); // Get current hour (0–23)
  const body = document.time;

  time.classList.remove('morning', 'afternoon', 'night');

  if (hour >= 5 && hour < 12) {
    time.classList.add('morning');
  } else if (hour >= 12 && hour < 18) {
    time.classList.add('afternoon');
  } else {
    time.classList.add('night');
  }
}

updateBackground();
setInterval(updateBackground, 60000);
</script>
</body>
</html>