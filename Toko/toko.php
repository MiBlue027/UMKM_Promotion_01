<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

      <!--    Google Font ----------------------------------------------------------->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

      <link rel="stylesheet" href="tokoStyle.css" />
      <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
      <link rel="stylesheet" href="../Footer/footerPageStyle.css">


  </head>
  <body>
      <?php
          include_once '../HeaderPackage/headerPage.php';
          include_once '../HeaderPackage/navigationPage.php';
      ?>
    <div class="content">
      <h1 class="judul">Toko Kami</h1>

      <div class="malang">
        <h3>Kota Malang</h3>
        <a href="https://maps.app.goo.gl/uPVsMJzFSwwbfQhk9">
          Jalan Lorem Ipsum nomor 23, Kelurahan Bandulan, Kecamatan Sukun, Kota
          Malang
        </a>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.405447068828!2d112.58722277500671!3d-7.956984692067614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78825bc65e176b%3A0x954b33ee83283be2!2sUniversitas%20Ma%20Chung!5e0!3m2!1sid!2sid!4v1731373886760!5m2!1sid!2sid"
          style="border: 2px solid silver"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="malang-map"
        ></iframe>
      </div>
      <div class="surabaya">
        <h3>Kota Surabaya</h3>
        <a href="https://maps.app.goo.gl/MxRwAsFQCj8DKVnFA">
          Jl. Raya Lontar No.2, Babatan, Kec. Wiyung, Surabaya, Jawa Timur 60123
        </a>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5607139083368!2d112.67166341086124!3d-7.290715971631164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fd9837199ca5%3A0x8c8393b71a3c843e!2sPakuwon%20Trade%20Center!5e0!3m2!1sid!2sid!4v1731374010422!5m2!1sid!2sid"
          style="border: 2px solid silver"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="ptc-map"
        ></iframe>
      </div>
    </div>

    <?php
        include_once '../Footer/footerPage.php';
    ?>
  </body>
</html>
