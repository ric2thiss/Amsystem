<?php
include 'functions/db.php';

$id = $_GET["id"];
if (make_admin($id)) {
    echo "<script>
    alert('Added new admin successfully!');  
    setTimeout(function() {
        window.location = 'index.php';
    }, 500);
</script>";
} else {
    echo "Already an Admin.";
    echo $id;
}

function make_admin($id) {
    $conn = databaseConnection();

    try {
  
        $stmt = $conn->prepare('UPDATE users SET isAdmin = 1 WHERE USERID = ?');
        $stmt->execute([$id]); 


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
