<?php
$email = $_POST["email_Address"];
//$_SESSION["email"]=$email;

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

// Check if the email exists in the database
$sql = "SELECT * FROM users WHERE email = '$email'";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error in prepare: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Email exists in the database, navigate the user to new_password.html
    header("Location: new_Password.html");
    exit();
} else {
    // Email does not exist in the database, display a JavaScript confirmation
    echo "<script>
            var message = ' لم يتم العثور على عنوان البريد الإلكتروني في قاعدة البيانات';
            alert(message);
            window.location.href = 'forgot_password.html';
          </script>";
    exit();
}
$stmt->close();
$conn->close();
?>


