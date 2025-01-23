<?php
require '../../Database/getConnection.php';
$connection = getConnection();
$sql = "SELECT testimony.*, users.username, transaction.id AS transaction_id 
        FROM testimony 
        JOIN users ON testimony.user_id = users.id 
        JOIN transaction_details ON testimony.transaction_details_id = transaction_details.id 
        JOIN transaction ON transaction_details.transaction_id = transaction.id";
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
    <title>Admin Testimoni</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            font-family: "Poppins", Arial, Helvetica, sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .main_title {
            color: #529ce8;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .container {
            width: 90vmax;
            margin: 0 auto;
            padding: 1rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            padding: 0.75rem;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-size: 1.2rem;
        }

        td {
            font-size: 1rem;
        }

        .tambah {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1rem;
        }

        .tambah a {
            padding: 0.5em 1em;
            background-color: #529ce8;
            border-radius: 5px;
            color: #ffffff;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .tambah a:hover {
            background-color: #86baff;
        }

        header {
            background-color: #529ce8;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        header a {
            color: white;
            margin: 0 1rem;
            text-decoration: none;
            font-weight: 500;
        }

        header a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php require_once '../adminNavigation.php' ?>
    <div class="container">
        <h1 class="main_title">List Testimoni</h1>
        <div class="testimoni">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Transaction ID</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Image 1</th>
                        <th>Image 2</th>
                        <th>Visibility</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $data) {
                    ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo htmlspecialchars($data['username']); ?></td>
                            <td><?php echo htmlspecialchars($data['transaction_id']); ?></td>
                            <td><?php echo htmlspecialchars($data['rating']); ?></td>
                            <td><?php echo htmlspecialchars($data['review']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($data['image1']); ?>" alt="Image 1" width="50"></td>
                            <td><img src="<?php echo htmlspecialchars($data['image2']); ?>" alt="Image 2" width="50"></td>
                            <td><?php echo $data['visibility'] ? 'Visible' : 'Hidden'; ?></td>
                            <td>
                                <a href="formCreateUpdateTestimoni.php?id=<?php echo $data['id']; ?>">Edit</a>
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