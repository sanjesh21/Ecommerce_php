<?php
include 'includes/db.php'; // Include your database connection script
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="main">
        <div class="container">
            <h2>Welcome to Our E-commerce Store</h2>
            <div class="products">
                <?php
                $sql = "SELECT p.*, c.name AS category_name 
                        FROM products p 
                        LEFT JOIN categories c ON p.category_id = c.id
                        LIMIT 12"; // Limiting the number of products to 12
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='product'>";
                        echo "<h3>" . $row["name"] . "</h3>";
                        echo "<p>Category: " . $row["category_name"] . "</p>";
                        echo "<img src='" . $row["image"] . "' alt='Product Image'>";
                        echo "<p>Description: " . $row["description"] . "</p>";
                        echo "<p>Price: $" . $row["price"] . "</p>";
                        echo "<a href='product_detail.php?id=" . $row["id"] . "' class='btn btn-primary'>View Details</a>";
                        echo "</div>";
                    }
                } else {
                    echo "No products available.";
                }
                ?>
            </div>
        </div>
    </div>
</body>
<footer>
<?php
include 'includes/footer.php';
?>
</footer>
</html>

