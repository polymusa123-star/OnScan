<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="table.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include_once('db.php');

  if(isset($_POST['btn2'])){
    $id = intval($_POST['id']);

    $del = "DELETE FROM scans WHERE id='$id'";
    if($db->query($del)){
     echo "<script>alert('Record deleted successfully'); window.location='table.php';</script>";
     exit();
    }
    else{
        echo "<script>alert('Error deleting record: " . $db->error . "');</script>";
    }
        exit();
    }

  $table = "SELECT 
 a.id AS scan_id,
 b.fullname,
 a.scan_time
FROM data AS b 
LEFT JOIN scans AS a 
ON a.qr_text LIKE CONCAT('%', b.idnumber, '%') 
ORDER BY a.scan_time DESC";

    $result = $db->query($table);
        
    ?>

      
           <input type="checkbox" id="tap">
           <label for="tap" class="btn" >=</label>
           <div class="menu-btn">
               <a href="index.php">home</a>
               <a href="scanner.php">scanner</a>
               <a href="login.php">QR generator</a>
               <a href="file.php">record</a>
           </div>

<a class="download" href="dowload_table.php" target="_blank">
    <button class="download-btn">Download as Document</button>
</a>

    <table>
        <thead>
            <th>name</th>
            <th>Date and Time</th>
        </thead>
    <tbody> 
        <?php while($rows=$result->fetch_assoc()):?>
                <tr>
                    
            <td><?=$rows["fullname"]?></td>
            <td><?=$rows["scan_time"]?></td>
           <td>
                   <form action="" method="POST">
                    <input type="hidden" name="id" value="<?=$rows["scan_id"]?>">
                   <button type="submit" name="btn2" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                </form>
                </a>
            </td>
                </tr>
      <?php endwhile; ?>
        </tbody>
    </table>
    
</body>
</html>