<?php
$database_name = "fcitclubs";
$servername = "localhost";
$username = "root";
$password = "mysql";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Select the database
if (!$conn->select_db($database_name)) {
    die("Could not select database: " . $conn->error);
}
// Start the session
session_start();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_new_password"];

    if ($newPassword == $confirmPassword) {
    // Hash the new password before saving it to the database
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the user's password in the database
    if(isset($_POST['email'])){
    $email= "".$_SESSION['email'];

    $updateQuery = "UPDATE users SET pas1 = '$hashedPassword' WHERE email = '$email'";
    
    if ($conn->query($updateQuery) === TRUE) {
        echo "Password updated successfully";
    } else {
        echo "Error updating password: " . $conn->error;
    }
} else {
    echo "Email not set in the session";
}
} else {
echo "Passwords do not match";
}
}

// Close the database connection
$conn->close();
?>
