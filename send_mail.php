<?php 
$hospital = $_GET['hospital'];
  $name = $_GET['name'];
  $user = $_GET['user'];
  $bed = $_GET['bed'];
  $b_rate = $_GET['b_rate'];
  $oxy = $_GET['oxy'];
  $oxy_rate = $_GET['oxy_rate'];
  $amb = $_GET['amb'];
  $amb_rate = $_GET['amb_rate'];
  $total = $_GET['total'];
  $date = $_GET['date'];

  $to=$user; 
  $message ="Hospital: ".$name."\nBed: ".$bed."\nBed Rate: ".$b_rate."\nOxygen: ".$oxy."\nOxygen Rate: ".$oxy_rate."\nAmbulance :".$amb."\nAmbulance Rate :".$amb_rate."\nTotal Amount :".$total."\nDate :".$date;
  // a random hash will be necessary to send mixed content
  $separator = md5(time());

  // carriage return type (RFC)
  $eol = "\r\n";

  // main header (multipart mandatory)
  $headers = "From: $name <$hospital>" . $eol;
  $headers .= "MIME-Version: 1.0" . $eol;
  $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
  $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
  $headers .= "This message from E-Hospital." . $eol;

  // message
  $body = "--" . $separator . $eol;
  $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
  $body .= "Content-Transfer-Encoding: 8bit" . $eol;
  $body .= $message . $eol;


  if(mail($to, $name, $message, $headers))
  {
    header('location:user_book_status.php');
  }
  else
  {
    header('location:user_book_status.php');
  }

?>