<?php
    include './functions/db.php';

    $id = $_GET["id"];
    if (delete_post($id)) {
        echo "
        <script>
            alert('Post deleted successfully!');  
            setTimeout(function() {
                window.location = 'index.php';
            }, 500);
        </script>
    ";
    } else {
        echo "Failed to delete post.";
        echo $id;
    }

    function delete_post($postId) {
        $conn = databaseConnection();

        try {
    
            $stmt = $conn->prepare('DELETE FROM posts WHERE POST_ID = ?');
            $stmt->execute([$postId]); 


            if ($stmt->rowCount() > 0) {
                return true; 
            } else {
                return false; // No post deleted (maybe post with given ID doesn't exist)
            }
        } catch (PDOException $e) {

            return false;
        }
    }
?>
