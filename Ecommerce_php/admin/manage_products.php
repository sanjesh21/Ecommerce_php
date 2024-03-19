<?php
// Include necessary files and start session
include 'admin-header.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: admin.php");
    exit;
}

// Include database connection
include '../includes/db.php';

// Function to fetch and display existing products
function displayProducts($conn) {
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td>" . $row["category_id"] . "</td>";
            echo "<td><img src='" . $row["image"] . "' width='50' height='50'></td>";
            echo "<td><button onclick='editProduct(" . $row["id"] . ")'>Edit</button> | <button onclick='deleteProduct(" . $row["id"] . ")'>Delete</button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No products found.</td></tr>";
    }
}

// Add product form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
    // Retrieve form data
    $productName = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $category_id = $_POST["category_id"];
    $image = $_FILES["image"]["name"];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // Add additional validation and sanitization if necessary
    
    // Upload image file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Image uploaded successfully, insert product into database
        $sql = "INSERT INTO products (name, description, price, category_id, image) VALUES ('$productName', '$description', '$price', '$category_id', '$image')";
        if ($conn->query($sql) === TRUE) {
            // Product added successfully
            header("Location: manage_products.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .main {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #343a40;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .add-product-form {
            margin-top: 20px;
        }

        .add-product-form input[type="text"],
        .add-product-form input[type="number"],
        .add-product-form input[type="file"],
        .add-product-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .add-product-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .add-product-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        // JavaScript functions for editing and deleting products
        function editProduct(productId) {
            // Logic for editing product
            alert('Edit product with ID: ' + productId);
        }

        function deleteProduct(productId) {
            // Logic for deleting product
            if (confirm("Are you sure you want to delete this product?")) {
                window.location.href = "manage_products.php?action=delete&id=" + productId;
            }
        }
    </script>
</head>
<body>
    <div class="main">
        <h2>Manage Products</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category ID</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php displayProducts($conn); ?>
        </table>
        
        <div class="add-product-form">
            <h2>Add Product</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Product Name" required><br>
                <input type="text" name="description" placeholder="Description" required><br>
                <input type="number" name="price" placeholder="Price" required><br>
                <input type="number" name="category_id" placeholder="Category ID" required><br>
                <input type="file" name="image" required><br>
                <input type="submit" name="add_product" value="Add Product">
            </form>
        </div>
    </div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
