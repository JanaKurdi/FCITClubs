<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> تسجيل الدخول </title>
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
    <!--nav bar-->
    <ul class="nav_main">
        <li><a class="notActive" href="index.html">الرئيسية</a></li>
        <li><a class="notActive" href="login.html">تسجيل الدخول</a></li>
        <li><a class="active" href="clubs.html">الاندية</a></li>
        <li><a class="notActive" href="contact.html">تواصل معانا</a></li>

        <form class="d-flex" role="search">
            <button class="Search_button" type="submit">بحث</button>
            <input class="form-control me-2" type="search" placeholder="بحث" aria-label="Search">

        </form>

    </ul>
    <!--end of nav bar-->
    <br><br><br>
    <br><br><br>
    <br><br><br>
<?php

$servername= "localhost";
$username = "root";
$password = "mysql";
$dbname = "fcitclubs";

$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
}else {

$conn->select_db("fcitclubs"); 
// Form submission handling
    $fname = $_POST["fname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
  
//firstname validation    
    if (!(preg_match('/[اأإء-ي]/ui', $fname))) {
        echo "    الاسم باللغة العربية فقط"   ;
        echo '<meta http-equiv="refresh" content="3;url=Signup.html">';
    }

//email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "    خطأ في إدخال الايميل يرجى كتابته بطريقة صحيحة";
        echo '<meta http-equiv="refresh" content="3;url=Signup.html">';
    }


 //password validation
   $passLength = strlen($password);
   $SpecialChar = preg_match('/[^a-zA-Z0-9]/',  $password);
   $Uppercase = preg_match('/[A-Z]/',  $password);
   $Number = preg_match('/[0-9]/', $password);

    if ($passLength < 8 || !$SpecialChar || !$Uppercase || !$Number) {
     echo "Password must contain at least 8 characters, one special character, one uppercase letter, and one number.";
     echo '<meta http-equiv="refresh" content="3;url=signup.html">';
     exit;
    } 
    if (!empty($fname) && !empty($email) && !empty($password)) {
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            // Email already exists, redirect to login page
            echo "    لديك حساب بالفعل .  جاري ارسالك إلى صفحة تسجيل الدخول...";
            echo '<meta http-equiv="refresh" content="3;url=login.html">';
            exit;
        }// Email does not exist, proceed with the registration
        $sql = "INSERT INTO users (fname, email, pas1) VALUES ('$fname', '$email', '$password');";

        if ($conn->query($sql) === TRUE) {
            echo "<h1>  تم التسجيل بنجاح!  </h1>";
            // Redirect to login page after successful registration
            header("Location: login.html");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();

?>
<!-- footer-->
<div class="footer">
    <ul class="list_footer">
        <li> <a href="index.html" style=>الرئيسية</a></li>
        <br>
        <li> <a href="clubs.html">الاندية</a></li>
        <br>
        <li> <a href="contact.html">تواصل معانا</a></li>
        <br>
    </ul>
    <br><br>
    <a href="https://www.instagram.com/king_abdulaziz_university_/?hl=ar"><img src="imeges/instagram.jpg" width="30"
            height="30" alt="instagram" /></a>
    <a href="https://twitter.com/kauweb"><img src="imeges/twitter.jpg" width="30" height="30" alt="twitter" /></a>
    <a href="https://www.facebook.com/KingAbdulazizUniversity"><img src="imeges/facebook.jpg" width="30" height="30"
            alt="facebook" /></a>
    <br><br>
    <p> © 2023 Copyright:</p>
    <a class="text-dark"> Design by Renad , Jana , Razan , and Jominah</a>
</div>
<!-- end of footer-->
</body>

</html>
