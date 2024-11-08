<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FAQ</title>
    <!-- boxicon start -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- boxicon end -->
    <!-- Style Start -->
    <link rel="stylesheet" href="faqStyle.css" />
      <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
      <link rel="stylesheet" href="../Footer/footerPageStyle.css">
    <!-- Style End -->
  </head>
  <body>
      <?php
          include_once '../HeaderPackage/headerPage.php';
          include_once '../HeaderPackage/navigationPage.php';
      ?>

    <div class="content">
      <h1>FAQ - Pertanyaan yang Sering Ditanyakan!</h1>
      <div class="accordion-pembelian-pengiriman">
        <h3>Informasi Pembelian & Pengiriman</h3>
        <div class="accordion-item">
          <button class="accordion-header" data-id="faq1">
            <i class="bx bx-plus-circle bx-sm"></i>
            <p>Di toko mana saja saya bisa membeli Keripik Beruah?</p>
          </button>
          <div class="accordion-content" id="faq1">
            <p>
              Anda dapat membeli Keripik Beruah di toko resmi kami di Malang
              atau melalui mitra resmi kami yang tersebar di berbagai kota besar
              di Indonesia.
            </p>
            <hr />
          </div>
        </div>
        <div class="accordion-item">
          <button class="accordion-header" data-id="faq2">
            <i class="bx bx-plus-circle bx-sm"></i>
            <p>Apakah Keripik Beruah tersedia di luar Malang?</p>
          </button>
          <div class="accordion-content" id="faq2">
            <p>
              Ya, kami memiliki beberapa mitra di luar Malang yang menjual
              produk kami, atau Anda bisa memesannya secara online di situs
              resmi kami.
            </p>
            <hr />
          </div>
        </div>
        <div class="accordion-item" >
          <button class="accordion-header" data-id="faq3">
            <i class="bx bx-plus-circle bx-sm"></i>
            <p>Apakah produk di marketplace (Shopee, Tokopedia, dll) asli?</p>
          </button>
          <div class="accordion-content" id="faq3">
            <p>
              Ya, produk Keripik Beruah yang dijual di marketplace resmi kami
              dijamin keasliannya. Pastikan Anda membeli dari akun resmi untuk
              menghindari produk palsu.
            </p>
            <hr />
          </div>
        </div>
        <div class="accordion-item">
          <button class="accordion-header" data-id="faq4">
            <i class="bx bx-plus-circle bx-sm"></i>
            <p>Apakah pemesanan bisa diantarkan ke rumah?</p>
          </button>
          <div class="accordion-content" id="faq4">
            <p>
              Ya, kami menyediakan layanan pengantaran ke rumah melalui jasa
              kurir lokal maupun ojek online di area tertentu.
            </p>
            <hr />
          </div>
        </div>
        <div class="accordion-item">
          <button class="accordion-header" data-id="faq5">
            <i class="bx bx-plus-circle bx-sm"></i>
            <p>Apakah Keripik Beruah bisa dikirim ke luar kota?</p>
          </button>
          <div class="accordion-content" id="faq5">
            <p>
              Kami menyediakan layanan pengiriman ke luar kota dengan packing
              khusus untuk memastikan produk sampai dalam kondisi baik.
            </p>
            <hr />
          </div>
        </div>
        <div class="accordion-item">
          <button class="accordion-header" data-id="faq6">
            <i class="bx bx-plus-circle bx-sm"></i>
            <p>Hari apa saja saya bisa membeli Keripik Beruah di toko?</p>
          </button>
          <div class="accordion-content" id="faq6">
            <p>
              Anda bisa mengunjungi toko kami setiap hari dari pukul 08.00
              hingga 20.00. Kami buka setiap hari, termasuk hari libur.
            </p>
            <hr />
          </div>
        </div>
      </div>
    </div>

      <script>
          document.querySelectorAll('.accordion-header').forEach(button => button.addEventListener('click', ()=>{
              document.querySelectorAll('.accordion-content').forEach(div => div.style.display = 'none');
              const targetId = button.getAttribute('data-id');
              document.getElementById(targetId).style.display = 'block';
          }));
      </script>

      <?php
        include_once '../Footer/footerPage.php';
      ?>
  </body>
</html>
