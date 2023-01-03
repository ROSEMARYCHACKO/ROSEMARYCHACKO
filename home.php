<?php
session_start();
if(!isset($_SESSION['user']))
{
    header('location:index.php');
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
  <title>Home</title>
  
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
        <p  style="color: rgb(255, 0, 106);"><?php echo $_SESSION['user']; ?></p>
        
        <a href="javascript:logout()" align="right"><div class="icon-holder">
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
<th >Hospitals:</th>
<th >Mail:</th>
<th >Address:</th>
<th >Type:</th>
<th >Bed:</th>
<th >Rate / bed:</th>
<th >oxygen:</th>
<th >Rate / Oxygen:</th>
<th >Ambulance:</th>
<th >Booking</th>
    </tr>
  </thead>
  <tbody id="myTable">

  <?php

       

$validation_for_hospitals =" select * from hosp WHERE dis='$dis'";
$result_for_hospitals = mysqli_query($conn, $validation_for_hospitals);


$i = 1;
while($row=mysqli_fetch_assoc($result_for_hospitals))
    {
        $name= $row['name'];
        $mail= $row['mail'];
        $address= $row['address'];
        $paid= $row['paid'];
        $ambulance= $row['ambulance'];

        /*for getting bed details*/ 

$validation_for_beds =" select * from beds WHERE hospital='$mail'";
$result_for_beds = mysqli_query($conn, $validation_for_beds);

while($row=mysqli_fetch_assoc($result_for_beds))
    {
        $qty= $row['qty'];
        $price= $row['price'];
        $oxygen= $row['oxygen'];
        $price_oxygen= $row['price_oxygen'];
        
        
    }
    /**/ 
    $count_for_beds = mysqli_num_rows($result_for_beds);

    if($count_for_beds !=0){


?>

    <tr >
      <th scope="row" class=" col-1"><?php echo $i; $i++; ?></th>
      
<td >
<?php echo  $name;?>
</td>
<td >
<?php echo  $mail;?>
</td>

<td >
<?php echo  $address;?>
</td>
<td >
<?php echo  $paid;?>
</td>

<td >
<?php echo  $qty;?>
</td>

<td >
<?php echo  $price." Rs";?>
</td>
<td >
<?php echo  $oxygen;?>
</td>

<td >
<?php echo  $price_oxygen." Rs";?>
</td>

<td >
<?php echo  $ambulance;?>
</td>

<td >
<a href="bed_book.php?hospital=<?php echo  $name;?>&&mail=<?php echo  $mail;?>"> Book</a>
</td>
    </tr>
    <?php }} ?>
  </tbody>
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
  function logout(){
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