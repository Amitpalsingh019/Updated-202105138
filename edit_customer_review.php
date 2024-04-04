<?php
require_once "config.php";

// Initialize variables
$param_id = $customer_name = $customer_review = $member_since = $favorite_product = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST["id"]);
    $customer_name = trim($_POST["customer_name"]);
    $member_since = trim($_POST["member_since"]);
    $favorite_product = trim($_POST["favorite-product"]);
    $customer_review = trim($_POST["customer_review"]);

    // Validate input
    // (You can add your validation logic here)

    // Update the database
    $sql = "UPDATE customer_reviews SET customer_name = ?, member_since = ?, favorite_product = ?, customer_review = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssi", $customer_name, $member_since, $favorite_product, $customer_review, $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "Review updated successfully.";
            echo '<script>window.location.href = "customer_review.php";</script>';
        } else {
            echo "Error updating review: " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
} else {
    if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
        $sql = "SELECT * FROM customer_reviews WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = trim($_GET['id']);
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $customer_name = $row['customer_name'];
                    $customer_review = $row['customer_review'];
                    $member_since = $row['member_since'];
                    $favorite_product = $row['favorite_product'];
                } else {
                    echo "No records found.";
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
    } else {
        echo "Invalid request.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer Review - Walnut Grocery Store</title>
    <link rel="stylesheet" href="css/review.css">
</head>

<body>
    <header>
        <h1>Edit Customer Review</h1>
    </header>

    <div class="nav">
        <a href="apple.html">HOME</a>
        <a href="apple2.html">Weekend Sale</a>
        <a href="apple3.html">Monthly Benefits</a>
        <a href="apple4.html">Buy One Get One</a>
        <a href="apple5.html">Careers</a>
        <a href="customer_review.php">Customer Reviews</a>
    </div>

    <section>
        <h2>Edit Review</h2>

        <div class="edit-review-form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($param_id); ?>">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>">
                </div>
                <div class="form-group">
                    <label>Member Since:</label>
                    <input type="text" name="member_since" value="<?php echo htmlspecialchars($member_since); ?>" required>
                </div>
                <div class="form-group">
                    <label>Favorite Product:</label>
                    <select id="favorite-product" name="favorite-product">
                        <option value="Fruits" <?php if ($favorite_product == "Fruits") echo "selected"; ?>>Fruits</option>
                        <option value="Vegetables" <?php if ($favorite_product == "Vegetables") echo "selected"; ?>>Vegetables</option>
                        <option value="Meat" <?php if ($favorite_product == "Meat") echo "selected"; ?>>Meat</option>
                        <option value="Dairy" <?php if ($favorite_product == "Dairy") echo "selected"; ?>>Dairy</option>
                        <option value="Vegan" <?php if ($favorite_product == "Vegan") echo "selected"; ?>>Vegan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Review:</label>
                    <textarea name="customer_review"><?php echo htmlspecialchars($customer_review); ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="button">Update</button>
                    <button type="button" class="button" onclick="window.location.href='customer_review.php'">Cancel</button>
                </div>
            </form>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Walnut Grocery Store. All rights reserved.</p>
    </footer>

</body>

</html>
