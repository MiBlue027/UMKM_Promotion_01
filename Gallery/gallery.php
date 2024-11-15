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
                <h1> Kegiatan Kami! </h1>
            </div>
            <div id="trendingTopicContainer">
                <div id="trendingContainerTitle">
                    <h1> Trending Now </h1>
                </div>
                <div id="trendingContent">
                    <table>
                        <tr>
                            <td rowspan="2">
                                <div class="topTrendingImage">
                                    <img src="../Asset/Gallery/event.jpg" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="trendingImage">
                                    <img src="../Asset/Gallery/eventsquare.jpg" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="trendingImage">
                                    <img src="../Asset/Gallery/eventsquare.jpg" alt="">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="trendingImage">
                                    <img src="../Asset/Gallery/eventsquare.jpg" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="trendingImage">
                                    <img src="../Asset/Gallery/eventsquare.jpg" alt="">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div id="galleryContentTitle">
                <h1> Gallery Content Title </h1>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
            </div>

            <div id="galleryContent">
                <div class="contentContainer">
                    <div class="contentImage">
                        <img src="../Asset/Gallery/eventregular.jpg" alt="">
                    </div>
                    <div class="contentTitle">
                        <h1> FoodMania </h1>
                    </div>
                    <div class="contentParagraph">
                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus mollitia numquam quos vitae voluptatibus. Vel! </p>
                    </div>
                </div>

                <div class="contentContainer">
                    <div class="contentImage">
                        <img src="../Asset/Gallery/eventregular.jpg" alt="">
                    </div>
                    <div class="contentTitle">
                        <h1> FoodGasme </h1>
                    </div>
                    <div class="contentParagraph">
                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus mollitia numquam quos vitae voluptatibus. Vel! </p>
                    </div>
                </div>

                <div class="contentContainer">
                    <div class="contentImage">
                        <img src="../Asset/Gallery/eventregular.jpg" alt="">
                    </div>
                    <div class="contentTitle">
                        <h1> Foodvoria </h1>
                    </div>
                    <div class="contentParagraph">
                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus mollitia numquam quos vitae voluptatibus. Vel! </p>
                    </div>
                </div>

                <div class="contentContainer">
                    <div class="contentImage">
                        <img src="../Asset/Gallery/eventregular.jpg" alt="">
                    </div>
                    <div class="contentTitle">
                        <h1> Foodies Heaven </h1>
                    </div>
                    <div class="contentParagraph">
                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus mollitia numquam quos vitae voluptatibus. Vel! </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once '../Footer/footerPage.php';
    ?>
</body>

</html>