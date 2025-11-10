
    <?php 
    include_once('db.php');
    ?>
    
     <?php
      date_default_timezone_set('Asia/Manila');

    if(isset($_POST['qr_text'])){
          $qr_text = mysqli_real_escape_string($db, $_POST['qr_text']);
          $scan_time = date("Y-m-d h:i:s A");

      $query = "INSERT INTO `scans`(`qr_text`,`scan_time`) VALUES ('$qr_text','$scan_time')";
      $q = mysqli_query($db,$query);
      if($q){
        echo "recorded!";
      }
      else{
        echo "Error!!". mysqli_error($db);
      }
    }
      ?>
