<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول  </title>
    <link rel="stylesheet" href="club.CSS">
    <link rel="stylesheet" href="NavBar_Footer.css">
    <style>
        p {
            background: #f5f7f6;
            text-align: center;
        }

        #table1 td,
        #table1 th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table1 tr:hover {
            background-color: #ddd;
        }

        #table1 th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #097947;
            color: white;
        }

        #table1 {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    



<?php

$servername= "localhost";
$username = "root";
$password = "mysql";
$dbname = "fcitclubs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
} else {
  $conn->select_db("fcitclubs");
  $email =$_POST["email"];
  $password =$_POST["password"];


//email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "    خطأ في إدخال الايميل يرجى كتابته بطريقة صحيحة";
   echo '<meta http-equiv="refresh" content="3;url=login.html">';
}


//password validation
$passLength = strlen($password);
$SpecialChar = preg_match('/[^a-zA-Z0-9]/',  $password);
$Uppercase = preg_match('/[A-Z]/',  $password);
$Number = preg_match('/[0-9]/', $password);

if ($passLength < 8 || !$SpecialChar || !$Uppercase || !$Number) {
 echo "Password must contain at least 8 characters, one special character, one uppercase letter, and one number.";
 echo '<meta http-equiv="refresh" content="3;url=login.html">';
 exit;
} 
if (!empty($email) && !empty($password)) {
    // Validate the user's email and password
    $sql = "SELECT * FROM users WHERE email = '$email' AND pas1 = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User is valid, redirect to the log-in page
        header("Location: index.html");
        exit();
    } else {
        // User is not valid, redirect to the sign-up page
        header("Location: Signup.html");
        exit();
    }
}
}
$conn->close();
?>


</body>

</html>
