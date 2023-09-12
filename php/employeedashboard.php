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

    <title>Dashboard</title>
    <style>
    body {
        background-color: #717082
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
                <li class="nav-item active">
                    <a class="nav-link" href="employeedashboard.php">Dashboard<span class="sr-only">(current)</span></a>
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
                    echo '<li class="nav-item">
                    <a class="nav-link" href="employeelogin.php">Login</a>
                </li>';
                }
                ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <hr style="margin:0px;">
    <?php
    session_start();
    if($_SESSION['employeeloggedin']){
        echo '<div class="container">
        <h2>
        Welcome <span style = "color:aliceblue;">'.$_SESSION['employee'].'!</span> Your inventories are as follows.
        </h2>
    </div>';
    }
    else{
        echo '<div class="container">
        <h2> <span style = "color:aliceblue;">
        Login</span> to see your inventories first.
        </h2>
    </div>';
    }
    $emp = $_SESSION['employee'];
    $sql = "SELECT * FROM `issueditem` WHERE `employee` = '$emp'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        echo '<div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h2 class="display-4">'.$row['item'].'</h2>
              <p class="lead">You have issued '.$row['quan'].' '.$row['item'].' </p>
              
                <a class="btn btn-primary btn-lg mr-5" href="addoneitem.php?item='.$row['item'].'&emp='.$row['employee'].'" role="button"> + </a>
                <a class="btn btn-primary btn-lg mr-5" href="removeoneitem.php?item='.$row['item'].'&emp='.$row['employee'].'" role="button"> - </a>
                <a class="btn btn-primary btn-lg ml-5" href="removeAllitem.php?item='.$row['item'].'&emp='.$row['employee'].'" role="button"> Remove </a>
              
            </div>
          </div>
          <hr>
        </div>';
    }
    ?>

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