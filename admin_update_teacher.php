<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['username']) || $_SESSION['usertype'] == 'student') {
    header("location:login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$port = 3307;
$db = "schoolproject";
$data = mysqli_connect($host, $user, $password, $db, $port);

if (isset($_GET['teacher_id'])) {
    $t_id = $_GET['teacher_id'];
    $sql = "SELECT * FROM teacher WHERE id='$t_id'";
    $result = mysqli_query($data, $sql);
    $info = $result->fetch_assoc();

    if (isset($_POST['update_teacher'])) {
        $id = $_POST['id'];
        $t_name = $_POST['name'];
        $t_des = $_POST['description'];
        $file = $_FILES['image']['name'];

        if (!empty($file)) {
            $dst = "./image/" . $file;
            $dst_db = "image/" . $file;
            move_uploaded_file($_FILES['image']['tmp_name'], $dst);
        } else {
            $dst_db = $info['image']; // keep old image if no new upload
        }

        $sql2 = "UPDATE teacher SET name='$t_name', description='$t_des', image='$dst_db' WHERE id='$id'";
        $result2 = mysqli_query($data, $sql2);

        if ($result2) {
            echo "<script>alert('Update Successful'); window.location.href='admin_view_teacher.php';</script>";
        }
    }
} else {
    echo "No teacher selected for update.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <?php include 'admin_css.php'; ?>
    <style type="text/css">
        label {
            display: inline-block;
            width: 150px;
            text-align: right;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .form_deg {
            background-color: skyblue;
            width: 600px;
            padding: 40px;
        }
    </style>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>

    <div class="content">
        <center>
            <h1>Update Teacher Data</h1>
            <form class="form_deg" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                <div>
                    <label>Teacher Name</label>
                    <input type="text" name="name" value="<?php echo $info['name']; ?>" required>
                </div>
                <div>
                    <label>About Teacher</label>
                    <textarea name="description" rows="4" required><?php echo $info['description']; ?></textarea>
                </div>
                <div>
                    <label>Teacher Old Image</label>
                    <img width="100px" height="100px" src="<?php echo $info['image']; ?>">
                </div>
                <div>
                    <label>Upload New Image</label>
                    <input type="file" name="image">
                </div>
                <div>
                    <input type="submit" name="update_teacher" value="Update Teacher" class="btn btn-success">
                </div>
            </form>
        </center>
    </div>
</body>
</html>
