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
    $item = $_POST['item'];
    $quan = $_POST['quan'];
    $use = $_POST['use'];
    $reserve = $_POST['reserve'];
    $date = $_POST['date'];
    $cost = $_POST['cost'];
    $success = '<div class="alert alert-success" role="alert">
    Hey user!, your Inventory has been inserted successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    $sql = "INSERT INTO `inventory` (`quantity`, `in_use`, `in_reserve`, `date_of_purchase`, `price`,`Item`) VALUES ('$quan', '$use', '$reserve', '$date', '$cost','$item')";
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

    <title>Inventory</title>
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
        <h1>Create Inventory Records!</h1>
        <form method = "post" action = "inventory.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Item</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Item name" name = "item">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Quantity</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Item quantity" name = "quan">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Items In Use</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Number of Items in use" name = "use">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Items In Reserve</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Number of Items in reserve" name = "reserve">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">DATE of Purchase</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="DD:MM:YYYY" name = "date">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Cost Per Item</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Cost per item" name = "cost">
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