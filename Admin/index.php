<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Svasth Admin</title>


  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.min.css'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

</head>

<body>

  <!-- datepicker source: https://github.com/uxsolutions/bootstrap-datepicker -->
<!-- tutorial: https://formden.com/blog/date-picker -->

<div class="container">
  <br />
  <div class="row">
    <div class='col-md-8'>
      <form class="" action="index.php" method="post">
        <div class="form-group col-md-5">
          <div id="filterDate2">

            <!-- Datepicker as text field -->
            <div class="input-group date" data-date-format="dd.mm.yyyy">



              <input  type="text" name="date" class="form-control" placeholder="dd.mm.yyyy">
              <div class="input-group-addon" >
                <span class="glyphicon glyphicon-th"></span>
              </div>
                   <div class='col-md-6'>
<select name="session">
  <option value="both">Both</option>
  <option value="morning">Morning</option>
  <option value="evening">Evening</option>
</select>
              </div>

            </div>


          </div>
        </div>
        <button id="download" type="submit">
 Submit</button>
      </form>
      <!-- <form class="" action="maptest.php" method="get">
          <input  type="hidden" name="date" value="<?php echo $date; ?>" class="form-control" placeholder="dd.mm.yyyy"></input>
        <button type="submit">
      Click here to see Map</button>
      </form> -->
      <div class="table">
        <table>
          <tr><th>SNo</th>
            <th>UserId</th>
            <th>OrderId</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>morning_litre</th>
            <th>evening_litre</th>
            <th>DSM</th>
            <th>BRM</th>
            <th>DLM</th>
            <th>delivery_time_m</th>
            <th>DSE</th>
            <th>BRE</th>
            <th>DLE</th>
            <th>delivery_time_e</th>
          </tr>

          <?php
          require 'dbconnection.php';
           $date= $_POST["date"];
            $session =$_POST["session"];

              switch ($session) {
              case 'both':
            $sql="select * from litre WHERE date ='$date' ";

                break;

                case 'morning':
             $sql="select * from litre WHERE date ='$date' AND NOT morning_litre='0'";

                  break;

                  case 'evening':
                $sql="select * from litre WHERE date ='$date' AND NOT evening_litre='0'";

                    break;
              default:
                # code...
                break;
            }

              $result=mysqli_query($db,$sql);

$count=0;
while($row=mysqli_fetch_array($result)){
$count+=1;
$id= $row['userid'];
$locationm=$row['delivery_location_m'];
$locatione=$row['delivery_location_e'];
 $sql1="select * from user where id= $id";
$result1=mysqli_query($db,$sql1);

while ($row1 = mysqli_fetch_array($result1)) {
  $name= $row1['name'];
  $email= $row1['email'];
  $mobile= $row1['mobile'];
}
?>
<tr>
<td><?php echo $count ?></td>
  <td><?php echo $row['userid']; ?></td>
  <td><?php echo $row['orderid']; ?></td>
  <td><?php echo $name; ?></td>
  <td><?php echo $email; ?></td>
  <td><?php echo $mobile; ?></td>
  <td><?php echo $row['morning_litre']; ?></td>
  <td><?php echo $row['evening_litre']; ?></td>
  <td><?php echo $row['delivery_status_m']; ?></td>
  <td><?php echo $row['bottle_received_m']; ?></td>
  <?php if (empty($row['delivery_location_m'])): ?>
<td>No location</td>
  <?php else: ?>
<td><a href="http://maps.google.com/?q=<?php  echo $row['delivery_location_m']; ?>" target="_blank">view location</a></td>
  <?php endif; ?>

  <td><?php echo $row['delivery_time_m']; ?></td>
  <td><?php echo $row['delivery_status_e']; ?></td>
  <td><?php echo $row['bottle_received_e']; ?></td>
  <?php if (empty($row['delivery_location_e'])): ?>
<td>No location</td>
  <?php else: ?>
<td><a href="http://maps.google.com/?q=<?php echo $row['delivery_location_e'] ?>" target="_blank">view location</a></td>
  <?php endif; ?>

  <td><?php echo $row['delivery_time_e']; ?></td>
</tr>
<?php
}
?>
        </table>
      </div>
      <form class="" action="export.php" method="get">
          <input  type="hidden" name="date" value="<?php echo $date; ?>" class="form-control" placeholder="dd.mm.yyyy"></input>
        <button type="submit">
      Click here to download</button>
      </form>
    </div>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script>



    <script  src="js/index.js"></script>




</body>

</html>
