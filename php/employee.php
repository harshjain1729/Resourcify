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
    $name = $_POST['name'];
    $design = $_POST['design'];
    $mail = $_POST['mail'];
    $mobile = $_POST['mobile'];
    $salary = $_POST['salary'];
    $success = '<div class="alert alert-success" role="alert">
    Hey buddy! your Employee data has been inserted successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    $sql = "INSERT INTO `employee` (`Name`, `Designation`, `mobile`, `mail`, `salary`) VALUES ('$name', '$design', '$mobile', '$mail', '$salary');";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo $success;
    }
    else{
        echo "data couldn't be inserted";
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

    <title>Employee</title>
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
    a{
        color: #ffffff;
    }
    a:hover{
        color: #000000;
        text-decoration: none;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Create Employee Records!</h1>
        <form method = "post" action = "employee.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Name" name = "name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Designation</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Your Designation" name = "design">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email Id</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter your Email Id" name = "mail">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mobile Number</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter your Mobile Number" name = "mobile">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Salary</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Your Salary" name = "salary">
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