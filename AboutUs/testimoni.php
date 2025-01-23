<?php
require_once __DIR__ . '/../Database/getConnection.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Testimoni</title>
    <!-- boxicon start -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- boxicon end -->

    <!-- style start -->
    <link rel="stylesheet" href="testimoniStyle.css" />
      <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
      <link rel="stylesheet" href="../Footer/footerPageStyle.css">
    <!-- style end -->
  </head>
  <body>
      <?php
          include_once '../HeaderPackage/headerPage.php';
          include_once '../HeaderPackage/navigationPage.php';
      ?>

    <div class="wrapper">
        <div class="testimonyContainer">
            <?php

            $connection = getConnection();

            $sql = "SELECT u.username, u.avatar, ty.rating, t.transaction_date, ty.review, ty.image1, ty.image2 FROM testimony ty
                        JOIN users u ON u.id = ty.user_id
                        JOIN transaction_details td ON td.id = ty.transaction_details_id
                        JOIN transaction t ON t.id = td.transaction_id
                        WHERE ty.visibility = 1";
            $statement = $connection->prepare($sql);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <div class="testimoni">
                    <div class="profileContainer">
                        <img src="<?php echo $row['avatar'] ?>" alt="" class="profile-picture" />
                        <div class="usernameRating">
                            <h3> <?php echo $row['username'] ?> </h3>
                            <div id="stars">
                                <?php for ($i = 0; $i < $row['rating']; $i++) {
                                    ?>
                                    <ion-icon name="star"></ion-icon>
                                    <?php
                                }
                                for ($j = 0; $j < 5 - $row['rating']; $j++) {
                                        ?>
                                        <ion-icon name="star-outline"></ion-icon>
                                        <?php
                                    }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="content-testi">

                        <p class="date"> <?php echo substr($row['transaction_date'],0, 10) ?> </p>
                        <p class="review"> <?php echo $row['review'] ?> </p>
                        <div class="image-testimoni">
                            <?php
                                if ($row['image1'] !== null) {
                                    ?>
                                    <img src="<?php echo $row['image1'] ?>" alt="" />
                                    <?php
                                }
                                if ($row['image2'] !== null) {
                                    ?>
                                    <img src="<?php echo $row['image2'] ?>" alt="" />
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <?php
            }

            $connection = null;

            ?>
        </div>
    </div>
    <?php
        include_once '../Footer/footerPage.php';
    ?>
  </body>
</html>
