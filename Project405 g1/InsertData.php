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
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $gender = $_POST["gender"];
        $major = $_POST["major"];
        $phoneNo = $_POST["phoneNo"];
        $more = $_POST["more"];
        $level = $_POST["level"];
        $interest = $_POST["interest"];
        $club = $_POST["club"];
        // check if name only contains letters 
        if (!(preg_match('/[اأإء-ي]/ui', $firstName))) {
            echo "الاسم باللغة العربية فقط";
            echo '<meta http-equiv="refresh" content="3;url=FormPage.html">';

        }

        // check if name only contains letters 
        if (!(preg_match('/[اأإء-ي]/ui', $lastName))) {
            echo "الاسم باللغة العربية فقط";
            echo '<meta http-equiv="refresh" content="3;url=FormPage.html">';
        }
        if (!(preg_match("/^[0-9]{10}+$/", $phoneNo))) {
            echo " (05########) رقم الجوال يتكون من ارقام فقط";
            echo '<meta http-equiv="refresh" content="3;url=FormPage.html">';

        }
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "خطأ في إدخال الايميل يرجى كتابته بطريقة صحيحة";
            echo '<meta http-equiv="refresh" content="3;url=FormPage.html">';
        }

        if (empty($gender)) {
            echo "يجب ان تختار الشطر طالبات ام طلاب";
            echo '<meta http-equiv="refresh" content="3;url=FormPage.html">';
        }

        if (empty($major)) {
            echo " يجب ان تختار التخصص";
            echo '<meta http-equiv="refresh" content="3;url=FormPage.html">';
        }
        if (empty($level)) {
            echo " يجب ان تختار المستوى";
            echo '<meta http-equiv="refresh" content="3;url=FormPage.html">';
        }
        if (empty($club)) {
            echo "يجب ان تختار احد النوادي من الخيارات";
            echo '<meta http-equiv="refresh" content="3;url=FormPage.html">';
        }
        if (!empty($firstName) && !empty($lastName) && !empty($phoneNo) && !empty($email) && !empty($gender) && !empty($major) && !empty($level) && !empty($interest) && !empty($club)) {
            // data is vaild now add to database
            $sql = "INSERT INTO request(phoneNo, email, firstname, lastname, gender, major, levelN, interest,more,club) 
    VALUES ($phoneNo,'$email','$firstName','$lastName','$gender','$major','$level','$interest','$more','$club');";

            if ($conn->query($sql) === TRUE) {
                echo "<p>تم ارسال طلب الانضمام بنجاح </p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // retrieve the data from database
            $sql = "SELECT * FROM request where phoneNo='$phoneNo';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table id='table1'>
                <tr> 
                 <th>Phone Number </th>
                <th>Name</th>   
                <th>email </th> 
                <th>gender</th> 
                <th>major</th> 
                <th>level </th> 
                <th>club</th> 
                <th>interest</th>
                <th>Operation</th> 

                </tr>";
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row["phoneNo"] . "</td>
                    <td>" . $row["firstname"] . " " . $row["lastname"] . "</td> 
                    <td>" . $row["email"] . "</td> 
                    <td>" . $row["gender"] . "</td> 
                    <td>" . $row["major"] . "</td> 
                    <td> " . $row["levelN"] . " </td> 
                    <td>" . $row["club"] . "</td> 
                    <td>" . $row["interest"] . "</td>
                    <td> <a href='Delete.php?phoneNo=". $row["phoneNo"]."'>Delete <a></td>

                    </tr>";
                }
                echo "</table>";

            } else {
                echo "retrieve data failed";
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
