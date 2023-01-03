<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Validation</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

</head>
<style>

</style>
<body>






</body>

</html>
<?php
include 'connection.php';
if (isset($_POST['submit'])){
   

$email = $_POST['ph'];
$pass = $_POST['pass'];




$validation ="select * from users WHERE mail = '$email' and password = '$pass'";
$result = mysqli_query($conn, $validation);
$count_for_user = mysqli_num_rows($result);

$hosp_validation = "select * from hosp WHERE mail = '$email' and password = '$pass'";
$hosp_result = mysqli_query($conn,$hosp_validation);
$count_for_hosp = mysqli_num_rows($hosp_result);

$admin_validation = "select * from super_user WHERE mail = '$email' and password = '$pass'";
$admin_result = mysqli_query($conn,$admin_validation);
$count_for_admin = mysqli_num_rows($admin_result);

if($count_for_user !=0){
    
   
        $_SESSION["user"] = $email;
        echo '<script>window.location.href = "home.php";</script>';

    
}
elseif($count_for_hosp !=0){
   
    

  
        
        $_SESSION["hospital"] = $email;
        echo '<script>window.location.href = "hosp_home.php";</script>';
   
   
}elseif($count_for_admin !=0){
   
    


    $_SESSION["admin"] = $email;
    echo '<script>window.location.href = "admin_home.php";</script>';

    
    
}
else{
      
    echo "<script language='javascript'>
    Swal.fire(
        'Error...!',
        'Username and password is wrong..!',
        'question'
      ).then(function() {
        window.location = 'login.php';
      });
  </script>
";

}


       
    
}
?>
