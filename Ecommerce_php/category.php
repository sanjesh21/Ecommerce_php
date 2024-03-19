<?php
// Include database connection
include_once './includes/db.php';

// Check if category_id is set in the URL
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Fetch products from the specified category
    $sql = "SELECT p.*, c.name AS category_name FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.category_id = $category_id";
    $result = $conn->query($sql);

    // Check if products exist
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<h3>" . $row["name"] . "</h3>";
            echo "<p>Category: " . $row["category_name"] . "</p>";
            echo "<img src='" . $row["image"] . "' alt='Product Image'>";
            echo "<p>Description: " . $row["description"] . "</p>";
            echo "<p>Price: $" . $row["price"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "No products available in this category.";
    }
} else {
    echo "Category ID is not specified.";
}

// Close database connection
$conn->close();
?>
