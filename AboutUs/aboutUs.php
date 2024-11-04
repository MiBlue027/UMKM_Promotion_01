<!DOCTYPE html>
<html lang="en">
  <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>About Us</title>
        <!-- Font Start-->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
          href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet"
        />
        <!-- Font End -->
        <!-- Style -->
      <link rel="stylesheet" href="aboutUsStyle.css" />
      <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
      <link rel="stylesheet" href="../Footer/footerPageStyle.css">

  </head>
  <body>

  <?php
      include_once '../HeaderPackage/headerPage.php';
      include_once '../HeaderPackage/navigationPage.php';
  ?>


  <div class="content">
      <!-- About Us Start -->
      <div class="container-about-us">
        <div class="about-us-company">
          <h1>Kriuk Beruah</h1>
          <div class="about-us-company-content">
            <img src="../Asset/AboutUsAsset/Logo Kriuk Berbuah.png" alt="Gambar logo" />
            <p>
              <span>Oleh Oleh Khas Malang</span><br />
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vero ea
              officia, vel magni ad numquam dolor repellendus earum voluptatibus
              porro voluptatem qui atque architecto, fugiat sapiente aspernatur?
              Necessitatibus facere incidunt nemo maiores corrupti cum placeat
              cumque atque dolores saepe excepturi molestias, voluptatibus ex
              quae minima distinctio suscipit, quas, eligendi fugiat rerum
              inventore? Pariatur, quas nobis veniam quam, veritatis ipsa vero
              dicta ipsam, esse exercitationem assumenda ut rem repellat maxime
              totam. Laudantium, praesentium doloribus architecto illo
              aspernatur sit at, magnam nulla obcaecati perspiciatis ullam.
              Ratione vitae adipisci, culpa iste necessitatibus expedita ipsam
              possimus quia sequi repudiandae amet! At aliquam aspernatur cum.
            </p>
          </div>
        </div>
      </div>
      <!-- About Us End -->
      <!-- Kenapa Memilih Kami Start -->
      <div class="reason-container">
        <h1>Kenapa Harus Memilih Kami?</h1>
        <div class="pilihan-buah-lokal">
          <img src="../Asset/AboutUsAsset/pilihan.png" alt="Buah Lokal" />
          <p>
            <span>Buah Lokal Pilihan</span><br />
            Kriuk Berbuah menggunakan buah-buahan segar langsung dari daerah
            Malang dan sekitarnya, yang terkenal dengan produksi buah
            berkualitas. Ini membuat produk kami menjadi oleh-oleh yang alami
            dan khas.
          </p>
        </div>

        <div class="pilihan-rasa">
          <p>
            <span>Varian Rasa yang Beragam</span><br />
            Kami menyediakan berbagai jenis keripik buah, mulai dari apel,
            nangka, pisang, hingga salak. Variasi ini kami hadirkan agar
            pelanggan dapat menikmati beragam rasa buah dalam bentuk camilan
            yang renyah dan lezat.
          </p>
          <img src="../Asset/AboutUsAsset/rasa.png" alt="Rasa yang Variatif" />
        </div>

        <div class="pilihan-harga">
          <img src="../Asset/AboutUsAsset/terjangkau.png" alt="Harga Terjangkau" />
          <p>
            <span>Harga Terjangkau</span> <br />
            Sebagai UMKM lokal, kami berkomitmen menghadirkan produk berkualitas
            dengan harga yang tetap terjangkau, sehingga cocok untuk dijadikan
            oleh-oleh khas Malang tanpa perlu merogoh kantong terlalu dalam.
          </p>
        </div>

        <div class="pilihan-praktis">
          <p>
            <span>Oleh-oleh Praktis dan Tahan Lama</span> <br />
            Keripik buah dari Kriuk Berbuah dikemas dengan baik agar tetap
            renyah dan tahan lama. Oleh karena itu, produk kami sangat cocok
            untuk dibawa pulang sebagai oleh-oleh, bahkan hingga ke luar kota
            atau luar negeri.
          </p>
          <img
            src="../Asset/AboutUsAsset/oleholeh.png"
            alt="oleh-oleh praktis dan tahan lama"
          />
        </div>
      </div>
      <!-- Kenapa Memilih Kami End -->
      <!-- Tentang owner Start-->
      <div class="tentang-owner">
        <img src="../Asset/AboutUsAsset/profile.png" alt="Foto owner" />
        <div class="description-owner">
          <p>
            <span>Tentang owner</span> <br />
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam
            incidunt minima possimus dolor repellat harum libero sed autem,
            exercitationem nemo voluptas nisi itaque. Impedit, pariatur nostrum?
            Molestiae nobis natus, officiis perspiciatis est, accusamus alias
            eveniet vel, numquam beatae aliquid molestias quo voluptatum! Culpa
            eum adipisci sequi magni doloremque architecto a corporis cupiditate
            totam tempore reprehenderit, quae ex dignissimos. Sequi facere,
            assumenda delectus nesciunt nisi voluptatibus numquam ea obcaecati
            nemo eos at alias ullam itaque autem inventore, earum velit
            voluptate! Harum, perferendis quaerat rem minus, temporibus deleniti
            nobis sit sint architecto odit, velit qui culpa. At ullam saepe quae
            veritatis libero?
          </p>
          <div class="owner-detail">
            <a href="ownerDetail.html"> Selengkapnya </a>
          </div>
        </div>
      </div>
      <!-- Tentang owner End-->
    </div>

      <?php
        include_once '../Footer/footerPage.php';
      ?>
  </body>
</html>
