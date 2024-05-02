<?php
    // include 'db.php';

    function write_post($idNum) {
        $conn = databaseConnection();
        $msg = '';
    
        if ($_POST) {
            // Retrieve data from $_POST array
            $title = isset($_POST["title"]) ? $_POST["title"] : '';
            $departmentOrg = isset($_POST["departmentOrg"]) ? $_POST["departmentOrg"] : '';
            $description = isset($_POST["description"]) ? $_POST["description"] : '';
    
            // Prepare and execute the SQL statement using a prepared statement
            $stmt = $conn->prepare('INSERT INTO posts (USERID, POST_TITLE, POST_DEPARTMENTORG, POST_DESCRIPTION) VALUES (?, ?, ?, ?)');
            $sent = $stmt->execute([$idNum, $title, $departmentOrg, $description]);
    
            // Check if the insert was successful
            if($sent){
                $msg = 'success';
            }else{
                // If no rows were affected, check for errors
                $errorInfo = $stmt->errorInfo();
                $msg = 'Failed to insert post. Error: ' . $errorInfo[2];
            }
        } else {
            $msg = 'No data received.';
        }
    
        return $msg;
    }
    function getAllPost_admin(){
            $conn = databaseConnection();
            $stmt = $conn->query('SELECT * FROM posts WHERE POST_STATUS = 0');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAllPost_published(){
        $conn = databaseConnection();
            $stmt = $conn->query('SELECT * FROM posts WHERE POST_STATUS = 1 ORDER BY post_date  DESC');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function countAllPost_admin() {
        $conn = databaseConnection();
        $stmt = $conn->query('SELECT COUNT(*) as total FROM posts WHERE POST_STATUS = 0');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    function countAllPublishedPost_admin() {
        $conn = databaseConnection();
        $stmt = $conn->query('SELECT COUNT(*) as total FROM posts WHERE POST_STATUS = 1');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    
    
    
?>