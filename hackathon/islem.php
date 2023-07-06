 <?php
 error_reporting(0);
 session_start();
 include 'baglanti.php';
 date_default_timezone_set('Europe/Istanbul');


 if (isset($_POST['register'])) {

  $kadi=htmlspecialchars($_POST['kadi']);
  $sifre=htmlspecialchars($_POST['sifre']);
  $sifreiki=htmlspecialchars($_POST['sifretekrar']);
  $mail=htmlspecialchars($_POST['email']);
  $adsoyad=htmlspecialchars($_POST['adsoyad']);
  $sifreguclu=md5($sifre);



  $kullanicisor=$baglanti->prepare("SELECT * from kullanici where kullanici_mail=:kullanici_mail");
  $kullanicisor->execute(array(

    'kullanici_mail'=>$mail,

  ));

  $var2=$kullanicisor->rowCount();


  if ($var2 > 0) {
    header("Location:login.php?durum=mailvar");
  }
  else{

    if ($sifre==$sifreiki) {

      if (strlen($sifre)>=8) {

        $kullanicikaydet=$baglanti->prepare("INSERT into kullanici SET 

          kullanici_sifre=:kullanici_sifre,   
          kullanici_mail=:kullanici_mail

          ");

        $insert=$kullanicikaydet->execute(array(

          'kullanici_sifre'=>$sifreguclu,
          'kullanici_mail'=>$mail


        ));
        if ($insert) {
          header("Location:index.php?durum=basarili");
        }
        else{
          header("Location:login.php?durum=basarisiz");
        }


      }
      else{
        header("Location:login.php?durum=sifreeksik");
      }

    }
    else{
      header("Location:login.php?durum=sifrehata");
    }

  }

}

if (isset($_POST['data'])) {
  $textarea = $_POST["data"];
  $id=$_POST["id"];
  $kimlikfoto=$baglanti->prepare("UPDATE odemeler SET 


    kimlikfoto=:kimlikfoto


    WHERE 

    id= 1 ");

  $insert=$kimlikfoto->execute(array(

    'kimlikfoto'=>$textarea



  ));
  if ($insert) {
    header("Location:index.php?durum=basarili");
  }
  else{
    header("Location:login.php?durum=basarisiz");
  }
}
