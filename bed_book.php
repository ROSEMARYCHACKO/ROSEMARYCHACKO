<!DOCTYPE html>
<html>

<head>
    <title>Book</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>

<body>

</body>

</html>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
include 'connection.php';

$user = $_SESSION['user'];
$h_mail = $_GET['mail'];

$validation_for_hospitals = " select * from hosp WHERE mail='$h_mail'";
$result_for_hospitals = mysqli_query($conn, $validation_for_hospitals);

while ($row = mysqli_fetch_assoc($result_for_hospitals)) {
    $name = $row['name'];
    $mail = $row['mail'];
    $address = $row['address'];
    $paid = $row['paid'];
    $amb = $row['ambulance'];
}
$validation_for_bed = " select * from beds WHERE hospital='$h_mail'";
$result_for_bed = mysqli_query($conn, $validation_for_bed);

while ($row = mysqli_fetch_assoc($result_for_bed)) {
    $hospital = $row['hospital'];
    $qty = $row['qty'];
    $price = $row['price'];
    $oxygen = $row['oxygen'];
    $price_oxygen = $row['price_oxygen'];
    $ambulance = $row['ambulance'];
    $amb_rate = $row['amb_rate'];
}

if (isset($_POST['submit'])) {



    $validation_for_user = " select * from users WHERE mail='$user'";
    $result_for_user = mysqli_query($conn, $validation_for_user);

    while ($row = mysqli_fetch_assoc($result_for_user)) {
        $name_of_user = $row['name'];
        $phone = $row['phone'];
    }

    $bed = $_POST['qty'];
    $bed_rate = $_POST['rate'];
    $oxygen_for_user = $_POST['ox'];
    $oxygen_for_user_rate = $_POST['oxp'];

    $ambulance_for_user = $_POST['amb'];
    $ambulance_for_user_rate = $_POST['pamb'];
    $user_total = $_POST['toatal'];

    $tqty = intval($qty) - intval($bed);
    $toxy = intval($oxygen) - intval($oxygen_for_user);
    $tamp = intval($ambulance) - intval($ambulance_for_user);

    $date = date("d/m/Y");
    $out = "0";

    if ($tqty < 0) {
        echo "Available bed is " . $qty;
    } elseif ($toxy < 0) {
        echo "Available Oxygen is " . $oxygen;
    } elseif ($tamp < 0) {
        echo "Available Ambulance is " . $ambulance;
    } else {
        $ststus = "in";
        $sql = "INSERT INTO bookings (name, phone, mail,bed,b_rate,oxygen,o_rate,ambulance,amb_rate,total,status,in_date,out_date)
    VALUES ('$name', '$phone','$user','$bed','$bed_rate','$oxygen_for_user','$oxygen_for_user_rate','$ambulance_for_user','$ambulance_for_user_rate','$user_total','$ststus','$date','$out')";
        if (mysqli_query($conn, $sql)) {



            $sql2 = "UPDATE beds SET qty='$tqty ',oxygen='$toxy',ambulance='$tamp'
            WHERE hospital = '$h_mail'";
            if (mysqli_query($conn, $sql2)) {

                echo "<script language='javascript'>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                Swal.fire({
                    title: 'Check Your Mail id',
                    showClass: {
                      popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                      popup: 'animate__animated animate__fadeOutUp'
                    }
                  }).then(function() {
                    window.location = 'send_mail.php?hospital=$h_mail&&name=$name&&user=$user&&bed=$bed&&b_rate=$bed_rate&&oxy=$oxygen_for_user&&oxy_rate=$oxygen_for_user&&amb=$ambulance_for_user&&amb_rate=$ambulance_for_user_rate&&total=$user_total&&date=$date';
                });
               
              });
          </script>
        ";
            } else {
                echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }}}
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
    <title>Book</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


</head>

<script>
    function addBed() {
        var a, b, c;
        var txtFirstNumberValue = document.getElementById('bed').value;
        var txtSecondNumberValue = <?php echo $price; ?>;
        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        if (!isNaN(result)) {
            document.getElementById('bedRateTotal').value = result;
        }

        var txtFirstNumberValue = document.getElementById('bedRateTotal').value;
        var txtSecondNumberValue = document.getElementById('oxp').value;
        var txtThirdNumberValue = document.getElementById('pamb').value;
        var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue) + parseInt(txtThirdNumberValue);
        if (!isNaN(result)) {
            document.getElementById('total').value = result;
        }
    }

    function addOxy() {
        var d, e, f;
        var txtFirstNumberValue = document.getElementById('ox').value;
        var txtSecondNumberValue = <?php echo $price_oxygen; ?>;
        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        if (!isNaN(result)) {
            document.getElementById('oxp').value = result;
        }

        var txtFirstNumberValue = document.getElementById('bedRateTotal').value;
        var txtSecondNumberValue = document.getElementById('oxp').value;
        var txtThirdNumberValue = document.getElementById('pamb').value;
        var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue) + parseInt(txtThirdNumberValue);
        if (!isNaN(result)) {
            document.getElementById('total').value = result;
        }
    }

    function addAmb() {
        var d, e, f;
        var txtFirstNumberValue = document.getElementById('amb').value;
        var txtSecondNumberValue = <?php echo $amb_rate; ?>;
        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        if (!isNaN(result)) {
            document.getElementById('pamb').value = result;
        }

        var txtFirstNumberValue = document.getElementById('bedRateTotal').value;
        var txtSecondNumberValue = document.getElementById('oxp').value;
        var txtThirdNumberValue = document.getElementById('pamb').value;
        var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue) + parseInt(txtThirdNumberValue);
        if (!isNaN(result)) {
            document.getElementById('total').value = result;
        }
    }
</script>

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
        <h1 style="text-align: center;"><?php echo $_GET['hospital']; ?></h1>
        <br>
        <div class="row " style="justify-content: center;margin-left: 7px !important;">

            <div class="col-md-2 card-1-1 ">
                <div class="card  rounded-top" style="height: auto;" align="center">
                    <p>Availabe beds : <?php echo $qty; ?></p>

                </div>
            </div>
            
            <?php
            if ($paid == "paid") { ?>
                <div class="col-md-2 card-1-1 ">
                <div class="card  rounded-top" style="height: auto;" align="center">
                    <p>Bed price : <?php echo $price; ?></p>

                </div>
            </div>
            <?php } ?>

            


            <div class="col-md-2 card-1-1 ">
                <div class="card  rounded-top" style="height: auto;" align="center">
                    <p>Available oxygen Cylinder : <?php echo $oxygen; ?></p>

                </div>
            </div>

            <div class="col-md-2 card-1-1 ">
                <div class="card  rounded-top" style="height: auto;" align="center">
                    <p>Oxygen Price: <?php echo $price_oxygen; ?></p>

                </div>
            </div>


            <div class="col-md-2 card-1-1 ">
                    <div class="card  rounded-top" style="height: auto;" align="center">
                        <p>Ambulance : <?php echo $ambulance; ?></p>
                    </div>
                </div>
                <div class="col-md-2 card-1-1 ">
                    <div class="card  rounded-top" style="height: auto;" align="center">
                        <p>Ambulance Price: <?php echo $amb_rate; ?></p>
                    </div>
                </div>
        </div>


    </section>
    <br>
    <br>

    <section>

        <div class="row " style="justify-content: center;margin-left: 7px !important;">

            <div class="col-md-4 card-1-1 ">
                <div class="card shadow-lg rounded-top" style="height: auto;" align="center">
                    <div id="formContent">




                        <form action="" method="post">

                            <label for="fname">Qty :</label><br>
                            <input type="number" id="bed" name="qty" value="1" required min="1" onkeyup="addBed()"><br><br>

                            <?php
                            if ($paid == "paid") { ?>
                                <label for="lname">Amount for bed :</label><br>

                                <input type="text" id="bedRateTotal" name="rate" value="<?php echo $price; ?>" readonly><br><br>
                            <?php } else { ?>
                                <input type="hidden" id="bedRateTotal" name="rate" value="0" readonly>
                            <?php } ?>
                            <label for="lname">Oxygen :</label><br>
                            <input type="number" id="ox" name="ox" value="0" required min="0" onkeyup="addOxy()"><br><br>
                            <label for="lname">Oxygen Price:</label><br>
                            <input type="text" id="oxp" name="oxp" value="0" required readonly><br><br>
                            <?php
                            if ($amb == "yes") { ?>
                                <label for="lname">Ambulance :</label><br>
                                <input type="text" id="amb" name="amb" value="0" required min="0" onkeyup="addAmb()"><br><br>
                                <label for="lname">Ambulance Price/ Person:</label><br>
                                <input type="text" id="pamb" name="pamb" value="0" readonly><br><br>
                            <?php } else { ?>

                                <input type="hidden" id="amb" name="amb" value="0">
                                <input type="hidden" id="pamb" name="pamb" value="0">
                            <?php } ?>
                            <label for="lname">Total:</label><br>

                            <input type="text" id="total" name="toatal" value="0" readonly><br><br>
                            <input type="submit" value="Book" name="submit">

                        </form>

                        <a href="user_book_status.php">View History</a>

                    </div>
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