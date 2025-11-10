<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="record.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include_once('db.php');
    ?>
     <div class="main">
        <input type="checkbox" id="tap">
        <label for="tap" class="btn" >=</label>
        <div class="menu-btn">
            <a href="index.php">home</a>
            <a href="scanner.php">scanner</a>
            <a href="login.php">QR generator</a>
            <a href="file.php">record</a>
        </div>
    <?php
    if(isset($_POST['btn'])){
        $id = intval($_POST['id']);

        $del = "DELETE FROM data WHERE idnumber='$id'";
        if($db->query($del)){
     echo "<script>alert('Record deleted successfully'); window.location='record.php';</script>";
     exit();
    }
    else{
        echo "<script>alert('Error deleting record: " . $db->error . "');</script>";
    }
        exit();
}
    $table = "SELECT fullname, contact, address, idnumber FROM data";

    $result = $db -> query($table);
    ?>
    <table>
       
            <tr>
            <thead>
                <th>full Name</th>
                <th>contact.</th>
                <th>address</th>
                <th>ID No.</th>
            </thead> 
        <tbody>
    <?php while ($rows= $result->fetch_assoc()):?>
            <td><?=$rows['fullname']?></td>
            <td><?=$rows['contact']?></td>
            <td><?=$rows['address']?></td>
            <td><?=$rows['idnumber']?></td>
             <td> 
                <form action="" method="POST">
                <input type="hidden" name="id" value="<?=$rows['idnumber']?>">
              <button type="submit" name="btn">Remove</button>
            </form>
            </td>
            </tr>
      <?php endwhile; ?>
        </tbody>
      
    </table>
</body>
</html>