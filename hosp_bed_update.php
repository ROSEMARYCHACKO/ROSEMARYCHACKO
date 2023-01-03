<?php
session_start();
if (!isset($_SESSION['hospital'])) {
    header('location:index.php');
}
include 'connection.php';


$hosp = $_SESSION['hospital'];
$validation = " select * from hosp where mail='$hosp'";
$result = mysqli_query($conn, $validation);

while ($row = mysqli_fetch_assoc($result)) {
    $mail = $row['mail'];
    $password = $row['password'];
    $paid = $row['paid'];
    $amb = $row['ambulance'];
}


$validation_for_beds = " select * from beds where hospital='$hosp'";
$result_for_beds = mysqli_query($conn, $validation_for_beds);


while ($row = mysqli_fetch_assoc($result_for_beds)) {
    $b_qty = $row['qty'];
    $price = $row['price'];
    $oxygen = $row['oxygen'];
    $price_oxygen = $row['price_oxygen'];
    $ambulance = $row['ambulance'];
    $amb_rate = $row['amb_rate'];
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
    <title>Update details</title>

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

            <div class="col-md-4 card-1-1 ">
                <div class="card shadow-lg rounded-top" style="height: auto;" align="center">
                    <div id="formContent">
                        <!-- Tabs Titles -->
                        <h2> Update Details </h2>


                        <!-- Add bEd Form -->

                        <form action="" method="post">

                            <label for="fname">Qty :</label><br>
                            <input autocomplete="off" type="text"  id="bed" name="qty" value="<?php echo $b_qty; ?>" required><br><br>

                            <?php
                            if ($paid == "paid") { ?>
                                <label for="lname">Amount/ bed :</label><br>
                                <input autocomplete="off" type="text" id="lname" name="rate" value="<?php echo $price; ?>"><br><br>
                            <?php } ?>
                            <label for="lname">Oxygen :</label><br>
                            <input autocomplete="off" type="text" id="ox" name="ox" value="<?php echo $oxygen; ?>"><br><br>
                            <label for="lname">Oxygen Price/ cylinder:</label><br>
                            <input autocomplete="off" type="text" id="oxp" name="oxp" value="<?php echo $price_oxygen; ?>"><br><br>

                            <?php
                            if ($amb == "yes") { ?>
                                <label for="lname">Ambulance :</label><br>
                                <input autocomplete="off" type="text" id="amb" name="amb" value="<?php echo $ambulance; ?>"><br><br>
                                <label for="lname">Ambulance Price/ Person:</label><br>
                                <input autocomplete="off" type="text" id="pamb" name="pamb" value="<?php echo $amb_rate; ?>"><br><br>
                            <?php } ?>
                            <input type="submit" value="update" name="submit">

                        </form>


                        
                        <br>
                        <br>

                    </div>
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


</body>

</html>
<?php


/*bed insertion*/

if (isset($_POST['submit'])) {
    $qty = $_POST['qty'];
    $rate = $_POST['rate'];
    $ox = $_POST['ox'];
    $oxp = $_POST['oxp'];

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

    $sql = "UPDATE beds SET qty='$qty', price='$rate',oxygen='$ox',price_oxygen='$oxp',ambulance='$amb',amb_rate='$pamb'
    WHERE hospital = '$hosp'";

    if (mysqli_query($conn, $sql)) {
        
        
        echo "<script language='javascript'>
  

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Updated Successfully..!',
            showConfirmButton: false,
            timer: 1500
          }).then(function() {
          window.location = 'hosp_bed_update.php';
        });
      </script>
      ";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


?>