<?php
$password = "HELLOWRL";

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo $hashedPassword;

if (password_verify($password, $hashedPassword)) {
    echo "<br>YES SAME!";
} else {
    echo "NO";
}
?>
