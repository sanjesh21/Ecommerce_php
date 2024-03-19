<?php
include 'admin-header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        
        li {
            margin-bottom: 10px;
        }
        
        li a {
            display: block;
            padding: 10px;
            background-color: #343a40;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        
        li a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="container">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="manage_products.php">Manage Products</a></li>
                <li><a href="manage_user.php">Manage Users</a></li>
                <li><a href="#">Manage Transactions</a></li>

            </ul>
        </div>
    </div>
</body>
</html>

<footer>
<?php
include '../includes/footer.php';
?>
</footer>
