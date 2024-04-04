<?php

require_once "config.php";


if(isset($_GET["id"]) && !empty($_GET["id"])){
   
    $sql = "DELETE FROM customer_reviews WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);

       
        $param_id = trim($_GET["id"]);

       
        if(mysqli_stmt_execute($stmt)){
          
            header("location: customer_review.php"); 
            exit();
        } else{
        
            echo "Oops! Something went wrong. Please try again later.";
        }

       
        mysqli_stmt_close($stmt);
    }

   
    mysqli_close($link);
} else {

    echo "Invalid request.";
}
