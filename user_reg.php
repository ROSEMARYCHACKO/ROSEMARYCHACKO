<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/icofont/icofont/icofont.css">
    <link rel="stylesheet" href="css/index.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--- datepicker link -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
    <title>Register</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                <a href="login.php" align="right">
                    <div class="icon-holder">
                        <div class="icon">
                            <i class="icofont-login"></i>
                        </div>
                        <span> login </span>
                    </div>
                </a>

            </div>
        </header>
    </section>



    <section style="margin-top: 200px;">

        <div class="row " style="justify-content: center;margin-left: 7px !important;">

            <div class="col-md-4 card-1-1 ">
                <div class="card shadow-lg rounded-top" style="height: auto;" align="center">
                    <div id="formContent">
                        <!-- Tabs Titles -->
                        <h2> Sign Up </h2>

                        <!-- Icon -->
                        <div>
                            <img src="img/user.png" id="icon" alt="User Icon" style="width:100px;height:100px;" />
                        </div>

                        <!-- SignUp Form -->

                        <form action="" method="post">

                            <input type="text" id="name" name="name" required placeholder="Name" autocomplete="off"><br>
                            <input autocomplete="off" placeholder="Phone" type="text" id="fname" name="ph" required maxlength="13" minlength="10" pattern="[1-9]{1}[0-9]{9}" title="Enter 10 digit mobile number"><br>



                            <input autocomplete="off" placeholder="Password" type="password" id="password" name="pass" resquired><br>
                            <input autocomplete="off" placeholder="Confirm Password" type="password" id="lname" name="cpass" required><br>
                            <input autocomplete="off" placeholder="Mail" type="email" id="mail" name="mail" required><br>
                            <input autocomplete="off" placeholder="Addres" type="text" id="lname" name="ad" required><br>

                            <label for="lname">District :</label><br>
                            <select name="dis">
                                <option value="ernakulam">Ernakulam</options>
                                <option value="kottayam">Kottayam</options> 
                                 <option value="kottayam">Pathanamthitta</options>
                                 <option value="kottayam">Kollam</options>
                                 <option value="kottayam">Kozhikode</options>
                                 <option value="kottayam">Thiruvananthapuram</options>
                                 <option value="kottayam">Kannur</options>
                            </select>
                            <br>
                            <br>
                            <input type="submit" value="Submit" name="submit">

                        </form>


                        <!-- Remind Passowrd -->
                        <div id="formFooter">
                            <a class="underlineHover" href="login.php">Login ?</a>
                        </div>
                        <br>
                        <br>

                    </div>
                </div>


    </section>
    <br>
    <br>




</body>

</html>

<?php
include 'connection.php';
if (isset($_POST['submit'])) {
    $ph = $_POST['ph'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $cpass = $_POST['cpass'];
    $mail = $_POST['mail'];
    $ad = $_POST['ad'];
    $dis = $_POST['dis'];




    if ($pass == $cpass) {
        $sql = "INSERT INTO users (name, phone, mail,password,address,dis)
VALUES ('$name', '$ph','$mail','$pass','$ad','$dis')";

        if (mysqli_query($conn, $sql)) {

            echo "<script language='javascript'>
  

    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Registered Successfully..!',
        showConfirmButton: false,
        timer: 1500
      }).then(function() {
      window.location = 'login.php';
    });
  </script>
  ";
        } else {


            echo "<script language='javascript'>
  

  Swal.fire(
    'Error...!',
    'Some error occured.!',
    'question'
  ).then(function() {
    window.location = 'user_reg.php';
  });
</script>
";
        }
    } else {
        echo "<script language='javascript'>
  

  Swal.fire(
    'Error...!',
    'Password is not match..!',
    'question'
  ).then(function() {
    window.location = 'user_reg.php';
  });
</script>
";
    }
}
?>