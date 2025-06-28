<?php
error_reporting(0);
session_start();
session_destroy();

if($_SESSION['message'])
{
    $message=$_SESSION['message'];
    echo "<script type='text/javascript'>
    alert('$message');
     </script>";
}
$host="localhost";
$user="root";
$password="";
$port=3307;
$db="schoolproject";
$data = mysqli_connect($host, $user, $password, $db, $port);
$sql="SELECT * FROM teacher ";
$result=mysqli_query($data, $sql);


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <label class="logo">W-School</label>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="">Admission</a></li>
            <li><a href="login.php" class="btn btn-success">Login</a></li>
        </ul>
    </nav>
    <div class="section1">
        <label class="img_text">We Teach Students With Care</label>
        <img class="main_img" src="school.png">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="welcome_img" src="playground.jpg">
            </div>
            <div class="col-md-8">
                <h1>Welcome to W-School</h1>
                <p>W-School has been dedicated to providing quality education with a global outlook since its establishment in 1997. As one of the pioneering English medium schools in India, W-School offers both CBSE and Cambridge curricula to cater to the diverse academic needs of students. We take pride in creating a vibrant, inclusive, and academically stimulating environment where innovation, creativity, and critical thinking are nurtured. At W-School, every student's voice is valued, and learning goes beyond textbooks to prepare them for a dynamic world.</p>
            </div>
        </div>
    </div>
    <center>
        <h1>Our Teachers</h1>
    </center>

    <div class="container">
        <div class="row">
            <?php
            while($info=$result->fetch_assoc())
            {
            ?>
            <div class="col-md-4">
                <img class="teacher" src="<?php echo"{$info['image']}" ?>">
                <h3><?php echo"{$info['name']}" ?></h3>
                <h5><?php echo"{$info['description']}" ?></h5>
            </div>
            <?php
            }
            ?>
            
        </div>
    </div>

    <center>
        <h1>Our Courses</h1>
    </center>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="teacher" src="web_development.png">
                <h3>Wed Development</h3>
            </div>
            <div class="col-md-4">
                <img class="teacher" src="graphic_design.png">
                <h3>Graphic Designing</h3>
            </div>
            <div class="col-md-4">
                <img class="teacher" src="digital_marketing.png">
                <h3>Marketing</h3>
            </div>
        </div>
    </div>


    <center>
        <h1 class="adm">Admission Form</h1>
    </center>
    <div align="center" class="admission_form">
        <form action="data_check.php" method="POST">
            <div class="adm_int">
                <label class="label_text">Name</label>
                <input class="input_deg" type="text" name="name">
            </div>
            <div class="adm_int">
                <label class="label_text">Email</label>
                <input class="input_deg" type="text" name="email">
            </div>
            <div class="adm_int">
                <label class="label_text">Phone</label>
                <input class="input_deg" type="text" name="phone"></input>
            </div>
            <div class="adm_int">
                <label class="label_text">Message</label>
                <textarea class="input_txt" name="message"></textarea>
            </div>
            <div class="adm_int">
                <input class="btn btn-primary" id="submit" type="submit" name="apply" value="Apply">
            </div>
        </form>
    </div>

    <footer>
        <h3 class="footer_text">All @copyright reserved by Kjanhavi25</h3>
    </footer>
</body>
</html>