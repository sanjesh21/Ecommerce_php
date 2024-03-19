<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Fetch cart items for the current user from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT c.*, p.name AS product_name, p.price AS product_price
        FROM cart c
        INNER JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any cart items
if ($result->num_rows > 0) {
    ?>
    <div class="container">
        <h2>Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                while ($row = $result->fetch_assoc()) {
                    $total_price += $row['quantity'] * $row['product_price'];
                    ?>
                    <tr>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>$<?php echo $row['product_price']; ?></td>
                        <td>$<?php echo $row['quantity'] * $row['product_price']; ?></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>$<?php echo $total_price; ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
} else {
    ?>
    <div class="container">
        <h2>Cart</h2>
        <p>Your cart is empty.</p>
    </div>
    <?php
}

?>
<footer>
<?php include 'includes/footer.php'; 
?>
</footer>
