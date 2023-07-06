<?php 
require_once 'baglanti.php';
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Multi Step Form Wizard in VanillaJS</title>
  <link rel="stylesheet" href="./style.css">
  <style type="text/css">

    button {
        width: 120px;
        padding: 10px;
        display: block;
        margin: 20px auto;
        border: 2px solid #111111;
        cursor: pointer;
        background-color: white;
    }

    #start-camera {
        margin-top: 50px;
    }

    #video {
        display: none;
        margin: 50px auto 0 auto;
    }

    #click-photo {
        display: none;
    }

    #dataurl-container {
        display: none;
    }

    #canvas {
        display: block;
        margin: 0 auto 20px auto;
    }

    #dataurl-header {
        text-align: center;
        font-size: 15px;
    }

    #dataurl {
        display: block;
        height: 100px;
        width: 320px;
        margin: 10px auto;
        resize: none;
        outline: none;
        border: 1px solid #111111;
        padding: 5px;
        font-size: 13px;
        box-sizing: border-box;
    }

</style>
</head>
<body>
    <!-- partial:index.partial.html -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Multi Stage Form Wizard</title>

        <link rel="stylesheet" href="css/style.css"/>
    </head>

    <body>

        <main>
            <div class="fw">
                <h1 class="fw__title">Mobilde Ödeme Sistemi</h1>
                <form action="islem.php" method="POST" class="fw__wrapper">
                     <fieldset class="fw__inputs fw__step">
                <div class="login-form">
                    <h3 class="fw__result__title">Kayıt Ol</h3>
                    <?php 

                    if (@$_GET['durum']=="kullanicivar") { ?>
                      <h6 class="fw__result__title" style="color:red">(Bu kullanıcı adı önceden alınmış)</h6>
                  <?php } elseif(@$_GET['durum']=="mailvar") { ?>
                     <h6 style="color:red">(Bu mail adresi kullanılıyor)</h6>
                 <?php } elseif(@$_GET['durum']=="sifrehata") { ?>
                     <h6 style="color:red">(Şifreler uyuşmuyor, lütfen iki şifreyi de aynı giriniz)</h6>
                 <?php } elseif(@$_GET['durum']=="sifreeksik") { ?>
                     <h6 style="color:red">(lütfen şifrenizi minimum 8 karakter olacak şekilde giriniz)</h6>
                 <?php } elseif(@$_GET['durum']=="basarili") { ?>
                     <h6 style="color:green;">(Kayıt başarılı Lütfen giriş yapınız)</h6>
                 <?php } elseif(@$_GET['durum']=="basarisiz") { ?>
                     <h6 style="color:red">(Başarısız)</h6>

                 <?php } ?>
                 <div class="row">
                   
                    
                    <div class="col-md-12 mb-20">
                        <label>Email Adresi</label>
                        <input name="email" required="" class="mb-0" type="email" placeholder="Email adresinizi giriniz">
                    </div>
                    <div class="col-md-6 mb-20">
                        <label>Şifre</label>
                        <input name="sifre" required="" class="mb-0" type="password" placeholder="Şifrenizi giriniz">
                    </div>
                    <div class="col-md-6 mb-20">
                        <label>Şifre tekrar</label>
                        <input name="sifretekrar" required="" class="mb-0" type="password" placeholder="Şifrenizi giriniz">
                    </div>
                    <div class="col-12">
                        <button name="register" class="register-button mt-0">Kayıt ol</button>
                    </div>
                </div>
            </div>
        </div>
         </fieldset>
    </form>


                <form action="islem.php" method="POST" id="form" class="fw__wrapper">
                    <fieldset class="fw__inputs fw__step">
                       <h4 class="fw__result__title">Kayıt Ol</h4>

                       <div class="form-group">
                           <input type="email" name="email" placeholder="E-mail" data-validation="email" data-label="Email" />
                       </div>


                       <div class="form-group">
                           <input type="password" name="sifre" placeholder="Şifre"  data-validation="password"/>
                       </div>
                       <div class="form-group">
                           <input type="password" name="sifretekrar" placeholder="Şifre Tekrar"  data-validation="password"/>
                       </div>



                       <div class="fw__inputs__error"><p class="fw__inputs__error--message"></p></div>



                       <input name="register" class="fw__button" type="button" value="Kaydol" />

                   </fieldset>

               </form>

           </div>
       </main>

       <script src="js/index.js"></script>

   </body>

   </html>
   <!-- partial -->
   <script>

    let camera_button = document.querySelector("#start-camera");
    let video = document.querySelector("#video");
    let click_button = document.querySelector("#click-photo");
    let canvas = document.querySelector("#canvas");
    let dataurl = document.querySelector("#dataurl");
    let dataurl_container = document.querySelector("#dataurl-container");

    camera_button.addEventListener('click', async function() {
        let stream = null;

        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
        }
        catch(error) {
            alert(error.message);
            return;
        }

        video.srcObject = stream;

        video.style.display = 'block';
        camera_button.style.display = 'none';
        click_button.style.display = 'block';
    });

    click_button.addEventListener('click', function() {
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        let image_data_url = canvas.toDataURL('image/jpeg');

        dataurl.value = image_data_url;
        dataurl_container.style.display = 'block';
    });

</script>
<script  src="./script.js"></script>

</body>
</html>
