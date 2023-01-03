<!DOCTYPE html>
<html>
<head>
<title>Delete</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>


</body>
</html>
<?php
$mail = $_GET['mail'];
$name = $_GET['hospital'];
include 'connection.php';

// sql to delete a record
$sql = "DELETE FROM hosp WHERE mail='$mail'";

if (mysqli_query($conn, $sql)) {
    // sql to delete a record
    $sql2 = "DELETE FROM bookings WHERE name='$name'";
    if (mysqli_query($conn, $sql2))  {
        $sql3 = "DELETE FROM beds WHERE hospital='$mail'";
        if (mysqli_query($conn, $sql3)) {
  
            echo "<script language='javascript'>
  

            Swal.fire({
                title: 'Deleted successfully..!',
                showClass: {
                  popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                  popup: 'animate__animated animate__fadeOutUp'
                }
              }).then(function() {
                window.location = 'hos_view.php';
            });
          </script>
          ";
        }
    }
} else {
    echo "Error deleting record: " . $conn->error;
}
