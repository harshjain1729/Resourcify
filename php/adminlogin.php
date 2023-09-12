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
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM `adminlogin` WHERE `admin_mail` = '$mail'";
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
        if($row['admin_pass'] == $pass){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $mail;
            // echo $success;
            header('Location: adminregister.php');
        }
        else{
            $_SESSION['loggedin'] = false;
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
    <div class="container">
        <form action = "adminlogin.php" method = "post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter email" name = "mail">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name = "pass">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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