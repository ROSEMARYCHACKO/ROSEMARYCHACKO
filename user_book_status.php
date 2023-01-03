<!DOCTYPE html>
<html>
<head>
<title>Book Hostory</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>

</body>
</html>
<?php
session_start();
if(!isset($_SESSION['user']))
{
    header('location:login.php');
}
include 'connection.php';
$user = $_SESSION['user'];

$validation =" select * from users WHERE mail='$user'";
$result = mysqli_query($conn, $validation);

while($row=mysqli_fetch_assoc($result))
    {
        $name= $row['name'];
        $dis = $row['dis'];
        $mail = $row['mail'];
    }

    $validation_for_booking =" select * from bookings WHERE mail='$user'";
$result_for_booking = mysqli_query($conn, $validation_for_booking);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/icofont/icofont/icofont.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--- datepicker link -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
    <title>Book Hostory</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    
</head>


<body>
    <section class="navigation shadow-lg" id="navigation">
        <header id="header" class="fixed-top shadow-lg">
            <div class="container-fluid px-md-3 d-flex align-items-center">
                <a href="index.php" class="logo mr-auto">
                    <h1 class="logo">
                        <div class="icon-holder">
                            <div class="icon">
                                <i class="icofont-hospital"></i>
                            </div>
                            <span>E- hospital </span>
                        </div>
                    </h1>
                </a>
                <p style="color: rgb(255, 0, 106);"><?php echo $_SESSION['user']; ?></p>

                <a href="javascript:logout()" align="right">
                    <div class="icon-holder">
                        <div class="icon-holder">

                            <div class="icon">
                                <i class="icofont-logout"></i>
                            </div>
                            <span> logout </span>

                        </div>



                    </div>
                </a>

        </header>
    </section>



    <section style="margin-top: 200px;">
  
  <div class=" table-responsive py-5" style="padding-left: 50px;padding-right: 50px;"> 
  <input  id="myInput" type="text" placeholder="Search.." style="width: auto;">
  <br>
<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr >
    <th class=" col-1">No:</th>
    
<th>Hospitals:</th>
<th>Beds:</th>
<th>Bed Rate:</th>
<th>Oxygen:</th>
<th>Oxygen Rate:</th>
<th>Ambulance:</th>
<th>Ambulance Rate:</th>
<th>Total:</th>
<th>In date:</th>
<th>Out date:</th>

    </tr>
  </thead>
  <tbody id="myTable">

  <?php

       

     

$validation_for_hospitals =" select * from hosp WHERE dis='$dis'";
$result_for_hospitals = mysqli_query($conn, $validation_for_hospitals);


$i = 1;
while($row=mysqli_fetch_assoc($result_for_booking))
    {
        $name_of_hospital= $row['name'];
        $bed = $row['bed'];
        $bed_rate = $row['b_rate'];
        $oxygen = $row['oxygen'];
        $o_rate = $row['o_rate'];
        $ambulance = $row['ambulance'];
        $amb_rate = $row['amb_rate'];
        $total = $row['total'];
        $status = $row['status'];
        $in_date = $row['in_date'];
        $out_date = $row['out_date'];
    


?>

    <tr >
      <th scope="row" class=" col-1"><?php echo $i; $i++; ?></th>
      <td>
<?php echo  $name_of_hospital;?>
</td>
<td>
<?php echo  $bed;?>
</td>

<td>
<?php echo  $bed_rate;?>
</td>
<td>
<?php echo  $oxygen;?>
</td>

<td>
<?php echo  $o_rate;?>
</td>

<td>
<?php echo  $ambulance." Rs";?>
</td>
<td>
<?php echo  $amb_rate;?>
</td>

<td>
<?php echo  $total." Rs";?>
</td>

<td>
<?php echo  $in_date;?>
</td>
<td>
<?php if($status == "in"){echo  "Currently you are ".$status;}else{echo $out_date;}?>
</td>



</tr>
<?php } ?>
</table>
</div>



 
</section>
    <br>
    <br>

   
    <script>
        function logout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are going to log out..!",

                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'logouted!',
                        'logouted successfully.',
                        'success'
                    ).then(function() {
                        window.location = 'logout.php';
                    });
                }
            })
        }
    </script>
    <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


</body>

</html>