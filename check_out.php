<?php
session_start();
include 'connection.php';

$user = $_SESSION['hospital'];
$mail = $_GET['mail'];
$id = $_GET['id'];

$validation_for_hospitals =" select * from hosp WHERE mail='$user'";
$result_for_hospitals = mysqli_query($conn, $validation_for_hospitals);

while($row=mysqli_fetch_assoc($result_for_hospitals))
    {
        $name= $row['name'];
        $h_mail= $row['mail'];
        $address= $row['address'];
        $paid= $row['paid'];
        $amb= $row['ambulance'];
    }

$validation_for_bed =" select * from beds WHERE hospital='$user'";
$result_for_bed = mysqli_query($conn, $validation_for_bed);

while($row=mysqli_fetch_assoc($result_for_bed))
    {
        $hospital= $row['hospital'];
        $qty = $row['qty'];
        $price = $row['price'];
        $oxygen = $row['oxygen'];
        $price_oxygen = $row['price_oxygen'];
        $ambulance = $row['ambulance'];
        $amb_rate = $row['amb_rate'];
    }

    
    $validation_for_booking =" select * from bookings WHERE name='$name' and mail='$mail'";
$result_for_booking = mysqli_query($conn, $validation_for_booking);
while($rows=mysqli_fetch_assoc($result_for_booking))
    {
        $phone= $rows['phone'];
        $bed = $rows['bed'];
      
        $oxygen_for_user = $rows['oxygen'];
     
        $ambulance_for_user = $rows['ambulance'];
        
        $total = $rows['total'];
        $in_date = $rows['in_date'];
        $out_date = $rows['out_date'];
    }

    $tqty = intval($qty) + intval($bed);
    $toxy = intval($oxygen) + intval($oxygen_for_user);
    $tamp = intval($ambulance) + intval($ambulance_for_user);

    $s_out ="out";
    $date = date("d/m/Y");
    $sql2 = "UPDATE bookings SET status='$s_out ',out_date='$date'
                WHERE name = '$name' and mail='$mail'";
            if (mysqli_query($conn, $sql2)) {
                
            $sql = "UPDATE beds SET qty='$tqty ',oxygen='$toxy',ambulance='$tamp'
            WHERE hospital = '$user'";
        if (mysqli_query($conn, $sql)) {
            header('location:view_bookings.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
            } else {
                echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
            }
?>