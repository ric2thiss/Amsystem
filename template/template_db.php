<?php
    function databaseConnections(){
        $server = "localhost";
        $username = "riccharl_Amsystem1";
        $password = "zox%DbLo0N0?";
        $dbname ="riccharl_Amsystem";
        $conn = null;
        
        try {
            $conn = new PDO("mysql:host=$server;dbname=$dbname", $username,$password);
            // Set PDO to throw exceptions on error
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $err) {
            // Handle connection error
            echo "Connection failed: " . $err->getMessage();
            // Exit or perform appropriate action
            return null;
            exit();
        }

    }
?>
