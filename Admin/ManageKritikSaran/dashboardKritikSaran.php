<?php
require '../../Database/getConnection.php';
$connection = getConnection();
$sql = "SELECT * FROM criticism_suggestions";
$statement = $connection->query($sql);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet" href="HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="Footer/footerPageStyle.css">
    <title>Admin Kritik dan Saran</title>
    <!--    Google Font ----------------------------------------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!--    Icon Link ---------------------------------------------------->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            font-family: "Poppins", Arial, Helvetica, sans-serif;
        }

        .main_title {
            color: #529ce8;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 0;
        }

        .container {
            width: 90vmax;
            position: relative;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        tr,
        td {
            padding: 0.5rem;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            font-size: 1.2rem;
            background-color: #f2f2f2;
        }

        td {
            font-size: 1rem;
        }

        .delete {
            color: red;
            text-decoration: none;
        }

        .delete:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php require_once '../adminNavigation.php' ?>
    <div class="container">
        <h1 class="main_title">List Kritik dan Saran</h1>
        <div class="criticism-suggestions">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $data) {
                    ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo htmlspecialchars($data['name']); ?></td>
                            <td><?php echo htmlspecialchars($data['email']); ?></td>
                            <td><?php echo htmlspecialchars($data['message']); ?></td>
                            <td>
                                <a href="deleteKritikSaran.php?id=<?php echo $data['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this suggestion?');">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>