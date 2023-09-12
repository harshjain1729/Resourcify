<?php
$server = "localhost";
$user  = "root";
$pass = "";
$db = "Lab";
$conn = mysqli_connect($server,$user,$pass,$db);
if(!$conn){
    die("could't connect to database due to this error-->".mysqli_connect_error($conn));
}
// else{
//     echo "connected successfully";
// }
if($_SERVER['REQUEST_METHOD']=='POST'){
    $mail = $_POST['mail'];
    $mobile = $_POST['mobile'];
    $design = $_POST['design'];
    $sql = "SELECT * FROM `employee` WHERE `mail` = '$mail'";
    $result = mysqli_query($conn, $sql);
    $numrow = mysqli_num_rows($result);
    $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Hey! '.$mail.', you have logged in successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    </div>';
    $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    Confirm your ID password once again.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    </div>';
    // echo $numrow;
    if($numrow==1){
        $row = mysqli_fetch_assoc($result);
        // echo var_dump($row);
        // echo $row['password'];
        if($row['mobile'] == $mobile&&$row['Designation']==$design){
            session_start();
            $_SESSION['employeeloggedin'] = true;
            $_SESSION['employee'] = $mail;
            // echo $success;
            header('Location: employeedashboard.php');
        }
        else{
            $_SESSION['employeeloggedin'] = false;
            echo $error;
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Login Here!</title>
    <style>
    body {
        margin: 0px;
        padding: 0px;
        background-color: #717082;
    }

    h2 {
        color: aliceblue;
    }

    label {
        color: antiquewhite;
    }

    small {
        color: #c9ddc7
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark text-light" style="background-color: #717080;">
        <a class="navbar-brand" href="#">Employee</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="employeedashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminlogin.php">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="issueitem.php">Inventory</a>
                </li>
                <?php
                session_start();
                if($_SESSION['employeeloggedin']){
                    echo '<li class="nav-item">
                    <a class="nav-link" href="employeelogout.php">Logout</a>
                </li>';
                }
                else{
                    echo '<li class="nav-item active">
                    <a class="nav-link" href="employeelogin.php">Login<span class="sr-only">(current)</span></a>
                </li>';
                }
                ?>
            </ul>
            <br>
            <br>
            <hr>
        </div>
    </nav>
    <hr style = "margin:0px;">ˀ
    <div class="container">
        <h2>Login as Employee here!!!</h2>
        <form action="employeelogin.php" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter email" name="mail">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Designation</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter tyour Designation"
                    name="design">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mobile Number</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter your Mobile no."
                    name="mobile">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>