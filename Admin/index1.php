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
      <div class="table">
        <table>
          <tr>
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
           $date= $_POST["date"];
            $session =$_POST["session"];
            echo $session;
          $sql="select * from litre WHERE date ='$date' ";
              $result=mysqli_query($db,$sql);


while($row=mysqli_fetch_array($result)){
$count+=1;
$id= $row['userid'];
 $sql1="select * from user where id= $id";
$result1=mysqli_query($db,$sql1);

while ($row1 = mysqli_fetch_array($result1)) {
  $name= $row1['name'];
  $email= $row1['email'];
  $mobile= $row1['mobile'];
}
?>
<tr>
  <td><?php echo $row['userid']; ?></td>
  <td><?php echo $row['orderid']; ?></td>
  <td><?php echo $name; ?></td>
  <td><?php echo $email; ?></td>
  <td><?php echo $mobile; ?></td>
  <td><?php echo $row['morning_litre']; ?></td>
  <td><?php echo $row['evening_litre']; ?></td>
  <td><?php echo $row['delivery_status_m']; ?></td>
  <td><?php echo $row['bottle_received_m']; ?></td>
  <td><?php echo $row['delivery_time_m']; ?></td>
  <td><?php echo $row['delivery_status_e']; ?></td>
  <td><?php echo $row['bottle_received_e']; ?></td>
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
