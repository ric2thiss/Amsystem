<?php
    // include 'db.php';

    function get_users_info(){
        $conn = databaseConnection();
        $stmt = $conn->query('SELECT * FROM users');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function write_message($sender_id, $recipient_id, $title, $departmentOrg, $message) {
        $conn = databaseConnection();
    
        try {
            // Prepare the SQL statement with named placeholders
            $stmt = $conn->prepare('INSERT INTO messages (sender_id, recipient_id, title, department, message) VALUES (:sender_id, :recipient_id, :title, :departmentOrg, :message)');
            
            // Bind the parameters to the SQL query
            $stmt->bindParam(':sender_id', $sender_id, PDO::PARAM_INT);
            $stmt->bindParam(':recipient_id', $recipient_id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':departmentOrg', $departmentOrg, PDO::PARAM_STR);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            
            // Execute the query
            $stmt->execute();
    
            // Check if the insertion was successful
            if ($stmt->rowCount() > 0) {
                return 'success';
            } else {
                return 'error';
            }
        } catch (PDOException $e) {
            // Log the error message and return 'error'
            error_log("Database error: " . $e->getMessage());
            return 'error';
        } finally {
            // Close the database connection
            $conn = null;
        }
    }


    // functions/Messages.php



function getMessagesForReceiver($receiver_id) {
    $conn = databaseConnection();
    // Prepare and execute SQL query to fetch messages for the specified receiver
    try {
        $stmt = $conn->prepare('SELECT * FROM messages WHERE recipient_id = ?');
        $stmt->execute([$receiver_id]);
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    } catch (PDOException $e) {
        // Handle database error
        return [];
    }
}

function get_receiver($receiver_id) {
    // Establish database connection
    $conn = databaseConnection();
    try {
        // Prepare and execute query to get user ID
        $stmt = $conn->prepare('SELECT USERID FROM users WHERE USERS_ID_NUMBER = ?');
        $stmt->execute([$receiver_id]);
        // Fetch user ID
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user['USERID']; // Return user ID
    } catch (PDOException $e) {
        // Handle database error
        return null; // Return null in case of error
    }
}



    
    
    
?>