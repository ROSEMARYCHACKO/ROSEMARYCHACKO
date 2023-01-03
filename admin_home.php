<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
include 'connection.php';


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
    <title>Admin Panel</title>

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
                <p style="color: rgb(255, 0, 106);"><?php echo $_SESSION['admin']; ?></p>

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

            <div class="col-md-6 card-1-1 ">
                <div class="card  rounded-top" style="height: auto;" align="center">
                    <a href="hos_reg.php">Register Hospitals</a>

                </div>
            </div>

            <div class="col-md-6 card-1-1 ">
                <div class="card  rounded-top" style="height: auto;" align="center">
                    <a href="hos_view.php">View Hospitals</a>

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