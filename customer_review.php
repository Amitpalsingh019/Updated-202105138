<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews - Walnut Grocery Store</title>
    <link rel="stylesheet" href="css/table_design.css">
</head>

<body>
    <header>
        <h1>Walnut Grocery Store - Customer Reviews</h1>
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
        <h2>Customer Reviews</h2>

        <div class="customer-reviews">
            <?php
            require_once "config.php";

            $sql = "SELECT id, customer_name, customer_review, favorite_product, member_since FROM customer_reviews";

            if ($result = mysqli_query($link, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr><th>S.No</th><th>Name</th><th>Favorite Product</th><th>Member Since</th><th>Review</th><th>Action</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['customer_name'] . "</td>";
                        echo "<td>" . $row['favorite_product'] . "</td>";
                        echo "<td>" . $row['member_since'] . "</td>";
                        echo "<td>" . $row['customer_review'] . "</td>";
                        echo "<td>";
                        echo "<a href='edit_customer_review.php?id=" . $row['id'] . "' class='edit-button'><button type='add'>Edit</button></a>";
                        echo "<a href='delete_customer_review.php?id=" . $row['id'] . "' class='delete-button' onclick='return confirm(\"Are you sure you want to delete this review?\")'><button type='cancel'>Delete</button></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    mysqli_free_result($result);
                } else {
                    echo "<p>No customer reviews found.</p>";
                }
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
            mysqli_close($link);
            ?>
        </div>

        <div class="add-review">
            <button type="add" class="button" onclick="navigateToAddReview()" class="button">Add Review</button>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Walnut Grocery Store. All rights reserved.</p>
    </footer>
    <script>
        function navigateToAddReview() {
            window.location.href = 'add_customer_review.html';
        }
    </script>

</body>

</html>
