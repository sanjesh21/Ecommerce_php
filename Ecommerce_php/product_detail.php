<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Check if product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect the user back to the products page or show an error message
    header("Location: products.php");
    exit();
}

// Get the product ID from the query parameter
$product_id = $_GET['id'];

// Fetch product details from the database based on the provided product ID
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

// Check if the product with the provided ID exists
if ($result->num_rows > 0) {
    // Product found, display its details
    $product = $result->fetch_assoc();

    // Get the quantity of this product in the user's cart
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $cart_quantity = 0;
    if ($user_id) {
        $cart_query = "SELECT quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id";
        $cart_result = $conn->query($cart_query);
        if ($cart_result->num_rows > 0) {
            $cart_row = $cart_result->fetch_assoc();
            $cart_quantity = $cart_row['quantity'];
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Details</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class="main">
            <div class="container">
                <h2>Product Details</h2>
                <div class="product">
                    <h3><?php echo $product["name"]; ?></h3>
                    <p>Category: <?php echo $product["category_id"]; ?></p>
                    <img src="<?php echo $product["image"]; ?>" alt="Product Image">
                    <p>Description: <?php echo $product["description"]; ?></p>
                    <p>Price: $<?php echo $product["price"]; ?></p>
                    <!-- Add to cart form with quantity selection -->
                    <form action="cart.php" method="post">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1">
                        <input type="hidden" name="product_id" value="<?php echo $product["id"]; ?>">
                        <p>Quantity in Cart: <?php echo $cart_quantity; ?></p>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
    <?php
} else {
    // Product with the provided ID not found, redirect the user back to the products page or show an error message
    header("Location: products.php");
    exit();
}

include 'includes/footer.php';
?>
