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
    <title> Transaction History </title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="transactionHistoryStyle.css">
    <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="../Footer/footerPageStyle.css">
</head>
<body>
<?php
include_once '../HeaderPackage/headerPage.php';
if (empty($_SESSION['username'])) {
    header('location: ../LoginPage/loginPage.php');
    exit();
}
include_once '../HeaderPackage/navigationPage.php';

$connection = getConnection();

// Pagination logic
$itemsPerPage = 5; // Number of items per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, $currentPage); // Ensure the current page is at least 1

// Fetch user ID
$sql = 'SELECT id FROM users WHERE username = :username';
$statement = $connection->prepare($sql);
$statement->bindValue(':username', $_SESSION['username']);
$statement->execute();
$userID = $statement->fetch(PDO::FETCH_ASSOC)['id'];

// Count total transactions
$sqlCount = "SELECT COUNT(*) as total FROM transaction t 
              JOIN transaction_details td ON t.id = td.transaction_id
              WHERE t.id_user = :user_id";
$statement = $connection->prepare($sqlCount);
$statement->bindValue(':user_id', $userID);
$statement->execute();
$totalTransactions = $statement->fetch(PDO::FETCH_ASSOC)['total'];

$totalPages = ceil($totalTransactions / $itemsPerPage);
$offset = ($currentPage - 1) * $itemsPerPage;


$sql = "SELECT td.id AS 'td_id', t.id, t.payment_method, t.transaction_date, p.product_image, p.product_name, p.variant, 
               p.price, p.product_description, td.quantity, td.testi_status 
        FROM transaction t 
        JOIN transaction_details td ON t.id = td.transaction_id
        JOIN product p ON td.product_id = p.id
        WHERE t.id_user = :user_id 
        LIMIT :limit OFFSET :offset";

$statement = $connection->prepare($sql);
$statement->bindValue(':user_id', $userID, PDO::PARAM_INT);
$statement->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
$statement->bindValue(':offset', $offset, PDO::PARAM_INT);
$statement->execute();

$transactions = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!--    INFORMATION ACTION ---------------------------------------------------------------------------->
<?php
require_once '../informationAction.php';
if (!empty($_GET['success'])) {
    if ($_GET['success'] === '1') {
        ?>
        <script> showIA("Berhasil", "Terima kasih atas reviewnya") </script>
        <?php
    }
}
?>

<!--    Main Content --------------------------------------------------------------------------------------->

<div class="wrapper">
    <div id="title">
        <h1> Riwayat Transaksi </h1>
        <p> Setiap transaksi Anda adalah ukiran berharga dalam perjalanan toko kami </p>
    </div>
    <div id="container">
        <table>
            <thead>
            <tr>
                <th> No. </th>
                <th colspan="2" style="text-align: left; width: 42%"> Product </th>
                <th> Harga </th>
                <th> Jumlah </th>
                <th> Total </th>
                <th> Pembayaran </th>
                <th style="width: 15%"> Tanggal Pembayaran </th>
                <th> Ulasan </th>
            </tr>
            </thead>
            <tbody>

            <?php
            $numbering = $offset + 1;
            $totalRow = 0;
            if ($transactions) {
                foreach ($transactions as $row) {
                    $totalRow++;
                    ?>
                    <tr>
                        <td> <?php echo $numbering++ ?>. </td>
                        <td style="text-align: left"> <img src="<?php echo $row['product_image'] ?>" alt="productImage" class="productImage"> </td>
                        <td> <h1 class="productTitle"> <?php echo $row['product_name'] ?> </h1> </td>
                        <td> <p> Rp <?php echo $row['price'] ?> </p> </td>
                        <td> <?php echo $row['quantity'] ?> </td>
                        <td> Rp <?php echo $row['price'] * $row['quantity'] ?></td>
                        <td> <?php echo $row['payment_method'] ?> </td>
                        <td> <?php echo substr($row['transaction_date'], 0, 19) ?> </td>
                        <td>
                            <?php if ($row['testi_status'] == 0) { ?>
                                <form action="../UserReview/userReview.php" method="POST">
                                    <input type="hidden" name="transactionID" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="transactionDetailID" value="<?php echo $row['td_id']; ?>">
                                    <button type="submit" class="reviewBTN">Beri Ulasan</button>
                                </form>
                            <?php } else { ?>
                                <span class="doneTestimony"> <ion-icon name="checkmark-done-outline"></ion-icon> </span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="9" style="font-weight: 550;"> Anda belum melakukan transaksi </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

<!--    Pagination Handler --------------------------------------------------------------------------------->
    <div class="paginationInformation">
        <p> Showing <?php echo $offset+1 ?> to <?php echo $offset + $totalRow ?> of <?php echo $totalTransactions ?> </p>
    </div>
    <div class="pagination">
        <?php if ($currentPage > 1){ ?>
            <a href="?page=1" class="paginationButton">&laquo; First</a>
            <a href="?page=<?php echo $currentPage - 1; ?>" class="paginationButton">&lsaquo; Previous</a>
        <?php } ?>

        <div class="gotoPageContainer">
            <label for="gotoPage" id="gotoPageLabel"> Go to
                <input type="text" id="gotoPage" value="<?php echo $currentPage ?>">
            </label>
        </div>

        <script>
            const gotoPage = document.getElementById('gotoPage');
            const totalPages = <?php echo $totalPages; ?>;

            gotoPage.addEventListener('change', function () {
                let page = parseInt(gotoPage.value, 10);

                if (isNaN(page) || page < 1) {
                    page = 1;
                } else if (page > totalPages) {
                    page = totalPages;
                }

                gotoPage.value = page;
                window.location.href = '?page=' + page;
            });
        </script>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?php echo $currentPage + 1; ?>" class="paginationButton">Next &rsaquo;</a>
            <a href="?page=<?php echo $totalPages; ?>" class="paginationButton">Last &raquo;</a>
        <?php endif; ?>
    </div>
</div>

<?php
include_once '../Footer/footerPage.php';
?>
</body>
</html>
