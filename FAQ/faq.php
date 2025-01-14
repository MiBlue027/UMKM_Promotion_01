<?php
require_once __DIR__ . '/../Database/getConnection.php';
?>

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
      <h1 id="faqTitle">FAQ - Pertanyaan yang Sering Ditanyakan!</h1>
      <div class="accordion-pembelian-pengiriman">
        <h3>Informasi Pembelian & Pengiriman</h3>
          <?php

          $connection = getConnection();

          $sql = 'SELECT * FROM faq';
          $statement = $connection->prepare($sql);
          $statement->execute();

          $faqID = 1;

          while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
              ?>
                  <div class="accordion-item">
                      <button class="accordion-header" data-id="faq<?php echo $faqID ?>">
                          <i class="bx bx-plus-circle bx-sm"></i>
                          <p> <?php echo $row['question'] ?> </p>
                      </button>
                      <div class="accordion-content" id="faq<?php echo $faqID++ ?>">
                          <p>
                              <?php echo $row['answer'] ?>
                          </p>
                          <hr />
                      </div>
                  </div>
              <?php

          }

          $connection = null;

          ?>

      </div>
    </div>

      <script>

          document.querySelectorAll('.accordion-header').forEach(button => {
              button.addEventListener('click', () => {
                  const targetId = button.getAttribute('data-id');
                  const targetContent = document.getElementById(targetId);
                  const icon = button.querySelector('.bx');

                  // Check if the clicked content is already open
                  const isOpen = targetContent.style.display === 'block';

                  // First close all accordions and reset icons
                  document.querySelectorAll('.accordion-content').forEach(content => {
                      content.style.display = 'none';
                      content.style.maxHeight = '0px';
                      content.style.opacity = '0';
                  });

                  document.querySelectorAll('.bx').forEach(icon => {
                      icon.classList.remove('bx-rotate-90');
                  });

                  // If the clicked content wasn't open, open it with animation
                  if (!isOpen) {
                      targetContent.style.display = 'block';
                      targetContent.style.opacity = '0';
                      targetContent.style.maxHeight = '0px';

                      // Trigger animation
                      setTimeout(() => {
                          targetContent.style.transition = 'all 0.3s ease-in-out';
                          targetContent.style.maxHeight = targetContent.scrollHeight + 'px';
                          targetContent.style.opacity = '1';
                          icon.classList.add('bx-rotate-90');
                      }, 10);
                  }
              });
          });
      </script>


      <?php
        include_once '../Footer/footerPage.php';
      ?>
  </body>
</html>
