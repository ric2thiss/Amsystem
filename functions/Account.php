<?php
include 'db.php';

function Create_Account(){
    $conn = databaseConnection();
    $msg = '';

    if (!empty($_POST)) {
        $idNum = isset($_POST['IDNUM']) ? $_POST['IDNUM'] : '';

        // Check if the account already exists based on USER_ID_NUM
        $stmt_check = $conn->prepare('SELECT COUNT(*) FROM users WHERE USERS_ID_NUMBER = ?');
        $stmt_check->execute([$idNum]);
        $count = $stmt_check->fetchColumn();

        if ($count > 0) {
            // Account already exists, display error message
            $msg = 'An account with the provided ID number already exists.';
        } else {
            // Proceed with creating the account
            $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
            $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
            $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $department = isset($_POST['department']) ? $_POST['department'] : '';
            $program = isset($_POST['program']) ? $_POST['program'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            // Prepare and execute the SQL statement using a prepared statement
            $stmt_insert = $conn->prepare('INSERT INTO users (`USERS_FIRSTNAME`, `USERS_LASTNAME`, `USERS_CONTACT`, `USERS_EMAIL`, `USERS_ID_NUMBER`, `USERS_DEPARTMENT`, `USERS_PROGRAM`, `USERS_PASSWORD`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            $success = $stmt_insert->execute([$firstname, $lastname, $contact, $email, $idNum, $department, $program, $password]);

            if ($success) {
                $msg = 'Record created successfully!';
            } else {
                // Handle the error
                $msg = 'Error creating record: ' . $stmt_insert->errorInfo()[2]; // Get the specific error message
            }
        }
    }
    return $msg;
}

function Login_Account($idNum, $password) {

    $conn = databaseConnection();
    $msg = '';

    // Prepare and execute the SQL statement using a prepared statement
    $stmt = $conn->prepare('SELECT * FROM users WHERE USERS_ID_NUMBER = ?');
    $stmt->execute([$idNum]); // Pass $idNum within an array
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a user with the provided ID number exists
    if ($user) {
        // Verify the provided password
        if ($user["USERS_PASSWORD"] === $password && $user["USERS_ID_NUMBER"] === $idNum) {
            $msg = 'success';
        } else {
            $msg = 'Incorrect password!';
        }
    } else {
        $msg = 'User not found!';
    }

    return $msg;
}

function get_account_name($idNum){
    
    $conn = databaseConnection();
    $msg = '';


    $stmt = $conn->prepare('SELECT * from users WHERE USERS_ID_NUMBER = ?');
    $stmt->execute([$idNum]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        return $user["USERS_FIRSTNAME"] . " " . $user["USERS_LASTNAME"];
    }else{
        $msg = "Something went wrong!";
        echo "<script>alert('$msg')</script>";
    }
}

function get_account_all_information($idNum){
    
    $conn = databaseConnection();
    $msg = '';


    $stmt = $conn->prepare('SELECT * from users WHERE USERS_ID_NUMBER = ?');
    $stmt->execute([$idNum]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        return $user;
    }else{
        $msg = "Something went wrong!";
        echo "<script>alert('$msg')</script>";
    }
}

function update_user($userId, $newFirstName, $newLastName, $newContact, $newEmail, $newPassword) {
    $conn = databaseConnection();

    try {
        // Prepare SQL statement to update user information
        $stmt = $conn->prepare('UPDATE users SET USERS_FIRSTNAME = ?, USERS_LASTNAME = ?, USERS_CONTACT = ?, USERS_EMAIL = ?, USERS_PASSWORD = ? WHERE USERID = ?');
        
        // Execute the SQL statement with parameters
        $result = $stmt->execute([$newFirstName, $newLastName, $newContact, $newEmail, $newPassword, $userId]);

        // Check if the update was successful
        if ($result) {
            return "success";
        } else {
            return "failed!";
        }
    } catch (PDOException $e) {
        // Handle database errors
        return "Error: " . $e->getMessage();
    }
}


?>
