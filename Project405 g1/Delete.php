<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> النوادي </title>
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
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = "fcitclubs";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $conn->select_db("fcitclubs");
        $phoneNo = (int)$_GET['phoneNo'];
        echo''. $phoneNo .'';
        $sql = "DELETE FROM request where phoneNo=".$phoneNo.";";
        $result = $conn->query($sql);
        if ($conn->query($sql) === true) {
            echo "<p>تم حذف طلب الانضمام بنجاح </p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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