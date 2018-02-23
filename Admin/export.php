<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");

// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=Svasth-Export.xls");
$date = $_GET['date'];
?>

<div class="table">
  <table>
    <tr>
    <th>No</th>
      <th>UserId</th>
      <th>OrderId</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>morning_litre</th>
      <th>evening_litre</th>
      <th>delivery_status_m</th>
      <th>bottle_received_m</th>
      <th>delivery_time_m</th>
      <th>delivery_status_e</th>
      <th>bottle_received_e</th>
      <th>delivery_time_e</th>
    </tr>

    <?php
    require 'dbconnection.php';
    $sql="select * from litre WHERE date ='$date' AND delivery_status_m='N'";
        $result=mysqli_query($db,$sql);

$no = 1;
while($row=mysqli_fetch_array($result)){
  echo '
  		<tr>
  			<td>'.$no.'</td>
  			<td>'. $row['userid'].'</td>
  			<td>'.$row['orderid'].'</td>
  			<td>'.$row['userid'].'</td>
  			<td>'.$row['userid'].'</td>
	      <td>'.$row['userid'].'</td>
        <td>'.$row['morning_litre'].'</td>
  		  <td>'.$row['evening_litre'].'</td>
        <td>'.$row['delivery_status_m'].'</td>
  		  <td>'.$row['bottle_received_m'].'</td>
        <td>'.$row['delivery_time_m'].'</td>
        <td>'.$row['delivery_status_e'].'</td>
  		  <td>'.$row['bottle_received_e'].'</td>
        <td>'.$row['delivery_time_e'].'</td>
  		</tr>
  		';
  		$no++;
}
?>
<!-- <tr>
<td><?php //echo $row['userid']; ?></td>
<td><?php //echo $row['orderid']; ?></td>
<td><?php //echo $row['userid']; ?></td>
<td><?php //echo $row['userid']; ?></td>
<td><?php //echo $row['userid']; ?></td>
<td><?php //echo $row['delivery_status_m']; ?></td>
<td><?php //echo $row['bottle_received_m']; ?></td>
</tr> -->

  </table>
</div>
