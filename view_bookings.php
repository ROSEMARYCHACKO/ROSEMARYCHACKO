<?php
session_start();
if(!isset($_SESSION['hospital']))
{
    header('location:index.php');
}
include 'connection.php';
$user = $_SESSION['hospital'];

$validation =" select * from hosp WHERE mail='$user'";
$result = mysqli_query($conn, $validation);

while($row=mysqli_fetch_assoc($result))
    {
        $name= $row['name'];
      
    }
    $status = "in";

    $validation_for_booking =" select * from bookings WHERE name='$name' and status='$status'";
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
    <title>View Bookings</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
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
                <p style="color: rgb(255, 0, 106);"><?php echo $_SESSION['hospital']; ?></p>

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

<div class="row " style="justify-content: center;margin-left: 7px !important;">

  <div class="col-md-6 card-1-1 "  >
    <div class="card  rounded-top" style="height: auto;" align="center" >
    <a href="user_book_status.php">History</a>

</div>
  </div>

 
</section>
<br>
<br>

<section >

<div class=" table-responsive py-5" style="padding-left: 50px;padding-right: 50px;"> 
<input  id="myInput" type="text" placeholder="Search.." style="width: auto;">
<br>
<table class="table table-bordered table-hover">
<thead class="thead-dark">
<tr >
<th class=" col-1">No:</th>
<th>Mail:</th>
<th>Ph NO.:</th>
<th>Bed:</th>
<th>Bed Rate:</th>
<th>Oxygen:</th>
<th>Oxygen Rate:</th>
<th>Ambulance :</th>
<th>Ambulance Rate:</th>
<th>Toatal Rate:</th>
<th>In date:</th>
<th>Out :</th>

</tr>
</thead>
<tbody id="myTable">

<?php

   

$i = 1;
while($row=mysqli_fetch_assoc($result_for_booking))
    {
        $id=$row['id'];
        $phone= $row['phone'];
        $mail = $row['mail'];
        $bed = $row['bed'];
        $b_rate = $row['b_rate'];
        $oxygen = $row['oxygen'];
        $o_rate = $row['o_rate'];
        $ambulance = $row['ambulance'];
        $amb_rate = $row['amb_rate'];
        $total = $row['total'];
        $in_date = $row['in_date'];
        $out_date = $row['out_date'];
    


?>

<tr >
  <th scope="row" class=" col-1"><?php echo $i; $i++; ?></th>
  <td>
<?php echo  $mail;?>
</td>
<td>
<?php echo  $phone;?>
</td>

<td>
<?php echo  $bed;?>
</td>
<td>
<?php echo  $b_rate;?>
</td>

<td>
<?php echo  $oxygen;?>
</td>

<td>
<?php echo  $o_rate." Rs";?>
</td>
<td>
<?php echo  $ambulance;?>
</td>

<td>
<?php echo  $amb_rate." Rs";?>
</td>

<td>
<?php echo  $total;?>
</td>
<td>
<?php echo  $in_date;?>
</td>
<td>
<a href="check_out.php?mail=<?php echo $mail; ?>&&id=<?php echo $id; ?>">Check Out</a>
</td>



</tr>
<?php } ?>
</table>
</div>




</section>
<br>
<br>

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


</body>

</html>
<?php


/*bed insertion*/

if (isset($_POST['submit'])) {
    $qty = $_POST['qty'];
    if (isset($_POST['rate'])) {
        $rate = $_POST['rate'];
    } else {
        $rate = 0;
    }

    if (isset($_POST['amb'])) {
        $amb = $_POST['amb'];
    } else {
        $amb = 0;
    }

    if (isset($_POST['pamb'])) {
        $pamb = $_POST['pamb'];
    } else {
        $pamb = 0;
    }

    $ox = $_POST['ox'];
    $oxp = $_POST['oxp'];

    $sql = "INSERT INTO beds (hospital, qty, price,oxygen,price_oxygen,ambulance,amb_rate)
    VALUES ('$hosp', '$qty','$rate','$ox','$oxp','$amb','$pamb')";

    if (mysqli_query($conn, $sql)) {
        
        echo "<script language='javascript'>
  

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Updated Successfully..!',
            showConfirmButton: false,
            timer: 1500
          }).then(function() {
          window.location = 'hosp_home.php';
        });
      </script>
      ";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}




?>