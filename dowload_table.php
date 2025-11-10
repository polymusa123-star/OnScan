<?php
include_once('db.php');

$query = "SELECT
 b.fullname,
 a.scan_time 
FROM data AS b 
LEFT JOIN scans AS a 
ON a.qr_text LIKE CONCAT('%', b.idnumber, '%') 
ORDER BY a.scan_time DESC";

$result = mysqli_query($db, $query);


header("Content-Type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=QR_Record_Table.doc");

echo "<h2 style='text-align:center;'>QR Record Report</h2>";
echo "<table border='1' cellspacing='0' cellpadding='6' style='border-collapse:collapse; width:100%; font-family:Arial;'>";
echo "<tr style='background:#f2f2f2; text-align:center;'>
        <th>Full Name</th>
        <th>date and time</th>
      </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['fullname']}</td>";
     echo "<td>" . ($row['scan_time'] ? $row['scan_time'] : '—') . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
