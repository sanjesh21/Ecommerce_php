<?php
include_once './includes/db.php';
include 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .card {
            width: 100%;
            margin-bottom: 20px;
        }

        .card-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="container">
            <h2>Products</h2>
            <div class="row">
                <?php
                $sql = "SELECT p.*, c.name AS category_name 
                        FROM products p 
                        LEFT JOIN categories c ON p.category_id = c.id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-6">
                            <div class="card">
                                <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                    <p class="card-text">Category: <?php echo $row['category_name']; ?></p>
                                    <p class="card-text"><?php echo $row['description']; ?></p>
                                    <p class="card-text">Price: $<?php echo $row['price']; ?></p>
                                    <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No products available.";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<footer>
<?php
include 'includes/footer.php';
?>
</footer>
