<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="log.css">
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
       </div>


<?php  
  include_once('db.php');
  require_once('phpqrcode/qrlib.php');
?>  
<?php

if(isset($_POST['btn'])){
    $fullname = $_POST['fullname'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $idnumber = $_POST['idnumber'];

     $folder = __DIR__ . "/qrcodes/";
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }    
    
    $check ="SELECT * FROM data WHERE `contact`='$contact' OR `idnumber`='$idnumber'";
    
    $checkResult = mysqli_query($db,$check);
    if(mysqli_num_rows($checkResult)>0){
        echo "<div class='msg'>already exist!!</div>";
        echo "<a  href='login.php' class='back'>back</a>";
        exit();
    }    
    
    $qrdata ="Name:$fullname\nContact: $contact\nAddress: $address\nID: $idnumber";
    $filepath = "qrcodes/$idnumber.png";
    $qrpath ="qrcode/".$idnumber .".png";
    
    $query = "INSERT INTO `data`(`fullname`,`contact`,`address`,`idnumber`,`qrimage`) 
    VALUE('$fullname','$contact','$address','$idnumber','$qrpath')";
    $q = mysqli_query($db,$query);
    
    if($q){
    echo "<p class='done'>done</p>";    
    
   
    if (!file_exists('qrcodes')) {
        mkdir('qrcodes');
        }

        QRcode::png($qrdata, $filepath, 'L', 5, 2);
       echo "
<div class='qr-box'>
  <img src='$filepath' alt='QR Code' class='img'><br>
  <a href='$filepath' download class='download-btn'>Download</a>
</div>";

    } else {
        echo "Error:class='msg' " . mysqli_error($db);
}        
}

?>

    <div class="mother">
        <form action="" method="POST">
        <label for="fullname">
    <input type="text" name="fullname" placeholder="FullNAME">
        </label>
        <label for="address">
    <input type="text" name="address" placeholder="ADDRESS">
        </label>
    <label for="contact">
    <input type="number" name="contact" placeholder="CONTACT">
        </label>
        <label for="idnumber" >
    <input type="number" name="idnumber" placeholder="ID NO.">
        </label><br>
        <button type="submit" name="btn">Add</button>
    </form>
</div>
</body>
</html>