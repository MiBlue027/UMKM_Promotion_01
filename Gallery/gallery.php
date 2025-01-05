<?php
require_once __DIR__ . '/../Database/getConnection.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="galleryStyle.css">
    <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="../Footer/footerPageStyle.css">


    <title> Galeri </title>
</head>

<body>
    <?php
    include_once '../HeaderPackage/headerPage.php';
    include_once '../HeaderPackage/navigationPage.php';
    ?>

    <div id="wrapper">
        <div id="galleryContainer">
            <div id="galleryTitle">
                <h1> Kegiatan Kami </h1>
            </div>
            <div id="trendingTopicContainer">
                <div id="trendingContainerTitle">
                    <h1> Trending Now </h1>
                </div>
                <div id="trendingContent">
                    <div class="topTrendingImageWrapper">

                        <?php

                        $connection = getConnection();
                        $sql = "SELECT * FROM gallery WHERE trending = 1";
                        $statement = $connection->prepare($sql);
                        $statement->execute();

                        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="topTrendingImage">
                                <div class="topTrendingImageInformation_Wrapper">
                                    <div class="topTrendingImageInformation">
                                        <h1> <?php echo $row["title"] ?> </h1>
                                        <p> <?php echo $row["article"] ?> </p>
                                    </div>
                                </div>
                                <img src="<?php echo $row["image"] ?>" alt="Event">
                            </div>
                            <?php
                        }

                        $statement = null;
                        $connection = null;
                        ?>

                    </div>

                    <div class="trendingNavigation">
                        <button class="prevTrendingImage">❮</button>
                        <button class="nextTrendingImage">❯</button>
                    </div>
                    <div class="dots"></div>
                </div>
            </div>
<!--Image Slider Script ----------------------------------------------------------------------------->
            <script>
                const slidesWrapper = document.querySelector('.topTrendingImageWrapper');
                const slides = document.querySelectorAll('.topTrendingImage');
                const prevButton = document.querySelector('.prevTrendingImage');
                const nextButton = document.querySelector('.nextTrendingImage');
                const dotsContainer = document.querySelector('.dots');

                let index = 0;

                // Create navigation dots
                slides.forEach((_, i) => {
                    const dot = document.createElement('button');
                    dot.classList.add('dot');
                    if (i === 0) dot.classList.add('active');
                    dot.addEventListener('click', () => {
                        index = i;
                        updateSlider();
                    });
                    dotsContainer.appendChild(dot);
                });

                const dots = document.querySelectorAll('.dots button');

                // Function to update the slider position
                const updateSlider = () => {
                    slidesWrapper.style.transform = `translateX(-${index * 100}%)`; // Move the wrapper
                    dots.forEach(dot => dot.classList.remove('active'));
                    dots[index].classList.add('active');
                };

                // Function to show the next slide
                const showNextSlide = () => {
                    index = (index + 1) % slides.length;
                    updateSlider();
                };

                // Function to show the previous slide
                const showPrevSlide = () => {
                    index = (index - 1 + slides.length) % slides.length;
                    updateSlider();
                };

                // Event listeners for buttons
                nextButton.addEventListener('click', showNextSlide);
                prevButton.addEventListener('click', showPrevSlide);

                // Auto-slide every 5 seconds
                setInterval(showNextSlide, 5000);

            </script>

<!--            All Gallery Content -------------------------------------------------------------------->
            <div id="galleryContentTitle">
                <h1> Gallery Content Title </h1>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
            </div>

            <div id="galleryContent">

                <?php
                $connection = getConnection();

                $sql = "SELECT * FROM gallery";
                $statement = $connection->prepare($sql);
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div class="contentContainer">
                        <div class="contentImage">
                            <img src="<?php echo $row["image"] ?>" alt="">
                        </div>
                        <div class="mainContent">
                            <div class="contentTitle">
                                <h1> <?php echo $row["title"] ?> </h1>
                            </div>
                            <div class="contentParagraph">
                                <p> <?php echo $row["article"] ?> </p>
                            </div>
                        </div>
                    </div>
                <?php
                }

                $statement = null;
                $connection = null;
                ?>

            </div>
        </div>
    </div>

    <?php
    include_once '../Footer/footerPage.php';
    ?>
</body>

</html>