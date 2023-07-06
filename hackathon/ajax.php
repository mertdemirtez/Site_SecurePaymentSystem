<?php
include 'baglanti.php';
 $textarea = $_POST["data"]; 



$kimlikfoto=$baglanti->prepare("INSERT into odemeler SET 

  kimlikfoto=:kimlikfoto 
  

  ");

$insert=$kimlikfoto->execute(array(

  'kimlikfoto'=>$textarea
 


));
if ($insert) {
  header("Location:index.php?durum=basarili");
}
else{
  header("Location:login.php?durum=basarisiz");
}
?>