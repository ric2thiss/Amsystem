<?php
include 'db.php';
function get_account_name($idNum){
    
    $conn = databaseConnection();

    $stmt = $conn->prepare('SELECT * from users WHERE USERS_ID_NUMBER = ?');
    $stmt->execute([$idNum]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        return $user["USERS_FIRSTNAME"] . " " . $user["USERS_LASTNAME"];
    }else{
        // Return a default value or handle the error in another way
        return "User Not Found";
    }
}

echo get_account_name(9);
?>