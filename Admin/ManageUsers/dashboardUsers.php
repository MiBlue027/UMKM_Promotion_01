<?php
require '../../Database/getConnection.php';
$connection = getConnection();
$sql = "SELECT * FROM users";
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
    <title>Admin Users</title>
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
    </style>
</head>

<body>
    <?php require_once '../adminNavigation.php' ?>
    <div class="container">
        <h1 class="main_title">List Users</h1>
        <div class="users">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Register Date</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $data) {
                    ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><img src="../<?php echo htmlspecialchars($data['avatar']); ?>" alt="Avatar" style="width: 50px; height: auto;"></td>
                            <td><?php echo htmlspecialchars($data['username']); ?></td>
                            <td><?php echo htmlspecialchars($data['email']); ?></td>
                            <td><?php echo htmlspecialchars($data['register_date']); ?></td>
                            <td><?php echo htmlspecialchars($data['address'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($data['phone_number'] ?? 'N/A'); ?></td>
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