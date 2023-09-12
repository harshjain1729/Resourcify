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
// echo "sdss";
session_start();
if(!$_SESSION['employeeloggedin']){
    header('Location: employeelogin.php');
}
// else if($_SERVER('REQUEST_METHOD')=='POST'){
$item = $_POST['item'];
$quan = $_POST['quan'];
$sql = "SELECT * FROM `inventory` WHERE `Item` = '$item'";
$result = mysqli_query($conn,$sql);
$numrow = mysqli_num_rows($result);
$employee = $_SESSION['employee'];
$success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
Hey! '. $empployee .', you have issued your inventory successfully.
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
if($numrow==1){
    while($row = mysqli_fetch_assoc($result)){
        if($row['in_reserve']>$quan){
            $reserve = $row['in_reserve'];
            $use = $row['in_use'];
            $remain = $reserve-$quan;
            $inuse = $use+$quan;
            $sql1 = "SELECT * FROM `issueditem` WHERE `item` = '$item' AND `employee` = '$employee'";
            $result1 = mysqli_query($conn, $sql1);
            $numrows = mysqli_num_rows($result1);
            if($numrows==1){
                while($row1 = mysqli_fetch_assoc($result1)){
                    $iniquan = $row1['quan'];
                    $finquan = $iniquan+$quan;
                    $sql3 = "UPDATE `issueditem` SET `quan` = '$finquan' WHERE `issueditem`.`item` = '$item' AND `issueditem`.`employee` = '$employee'";
                    $result3 = mysqli_query($conn,$sql3);
                }
            }
            else{
                $sql1 = "INSERT INTO `issueditem` (`item`, `employee`, `quan`) VALUES ('$item', '$employee', '$quan');";
                $result1 = mysqli_query($conn, $sql1);
            }
            $sql2 = "UPDATE `inventory` SET `in_reserve` = '$remain' WHERE `inventory`.`Item` = '$item'";
            $result2 = mysqli_query($conn, $sql2);
            echo $success;
            $sql3 = "UPDATE `inventory` SET `in_use` = '$inuse' WHERE `inventory`.`Item` = '$item'";
            $result3 = mysqli_query($conn,$sql3);
        }
        else{
            echo $error;
        }
    }
}

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

    <title>Issue the item</title>
    <style>
    body {
        background-color: #bcbcbc;
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
                    <a class="nav-link" href="adminregister.php">Admin</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="issueitem.php">Inventory<span class="sr-only">(current)</span></a>
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
        </div>
    </nav>
    <hr style = "margin:0px;">
    <br>
    <br>
    <div class="container">
        <h2>
            Issue your <span style = "color:#007bff;">Inventories</span> here...
        </h2>
        <form method="post" action="issueitem.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Item name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter item name" name="item">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Quantity</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter quantity"
                    name="quan">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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