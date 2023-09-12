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
    $cpass = $_POST['cpass'];
    $success = '<div class="alert alert-success" role="alert">
    Hey! '.$mail.', your data has been inserted successfully.
    </div>';
    $error = '<div class="alert alert-danger" role="alert">
    Confirm your ID password once again.
    </div>';
    $error1 = '<div class="alert alert-danger" role="alert">
    This data already exists. You can\'t register again.
</div>';
    if($pass==$cpass){
        $sql = "INSERT INTO `adminlogin` (`admin_mail`, `admin_pass`) VALUES ('$mail', '$pass');";
        $result = mysqli_query($conn, $sql);
        if($result){
          header('Location: adminlogin.php');
        }
        else{
          echo $error1;
        }
    }
    else{
      echo $error;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Register Here as Admin!</title>
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

    a {
        color: #ffffff;
    }

    a:hover {
        color: #000000;
        text-decoration: none;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg"  style="background-color: #717082">
        <a class="navbar-brand" href="adminregister.php">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="adminregister.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php
                session_start();
                if($_SESSION['loggedin']){
                    echo '<li class="nav-item">
                    <a class="nav-link" href="employee.php">AddEmployee</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="inventory.php">AddInventory</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
                </li>';
                }
                else{
                    echo '<li class="nav-item">
                    <a class="nav-link" href="adminlogin.php">Login</a>
                </li>';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="employeedashboard.php">Employee</a>
                </li>
            </ul>
        </div>
    </nav>
    <hr style = "margin:0px;">
    <div class="container">
        <h2>Register yourself here as Admin...</h2>
        <hr>
        <form method="post" action="adminregister.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter email" name="mail">
                <small id="emailHelp" class="form-text">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                    name="pass">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Confirm your Password" name="cpass">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <?php
            session_start();
            if($_SESSION['loggedin']){
                echo '<button type="submit" class="btn btn-primary ml-1"><a href = "logout.php">Logout</a></button>';
                echo '<button type="submit" class="btn btn-primary ml-2"><a href = "employee.php">Employees</a></button>';
                echo '<button type="submit" class="btn btn-primary ml-2"><a href = "inventory.php">Inventories</a></button>';

            }
            else{
                echo '<button type="submit" class="btn btn-primary"><a href = "adminlogin.php">Login</a></button>';
            }
            ?>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>