<?php
include './functions/db.php';

$id = $_GET["id"];
if (approve_post($id)) {
    echo "<script>
    alert('Post approved successfully!');  
    setTimeout(function() {
        window.location = 'index.php';
    }, 1000);
</script>";
} else {
    echo "Failed to approve post.";
    echo $id;
}

function approve_post($postId) {
    $conn = databaseConnection();

    try {
  
        $stmt = $conn->prepare('UPDATE posts SET POST_STATUS = 1 WHERE POST_ID = ?');
        $stmt->execute([$postId]); 


        if ($stmt->rowCount() > 0) {
            return true; 
        } else {
            return false; // No post updated (maybe post with given ID doesn't exist)
        }
    } catch (PDOException $e) {

        return false;
    }
}
?>
