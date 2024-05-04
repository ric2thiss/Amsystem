<?php
include './functions/db.php';

$id = $_GET["id"];
if (archive_post($id)) {
    echo "<script>
    alert('Post successfully back in pendings!');  
    setTimeout(function() {
        window.location = 'index.php';
    }, 500);
</script>";
} else {
    echo "Failed to Archive post.";
    echo $id;
}

function archive_post($postId) {
    $conn = databaseConnection();

    try {
  
        $stmt = $conn->prepare('UPDATE posts SET POST_STATUS = 0 WHERE POST_ID = ?');
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
