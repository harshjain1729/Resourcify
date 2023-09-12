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
$item = $_GET['item'];
// echo $item;
$emp = $_GET['emp'];
// echo $emp;
$sql = "SELECT * FROM `inventory` WHERE `Item` = '$item'";
$result = mysqli_query($conn,$sql);
$numrow = mysqli_num_rows($result);
if($numrow==1){
    while($row = mysqli_fetch_assoc($result)){
        $reserve = $row['in_reserve'];
        $remain = $reserve -1;
        $use = $row['in_use'];
        $inuse = $use+1;
        $sql2 = "UPDATE `inventory` SET `in_reserve` = '$remain' WHERE `inventory`.`Item` = '$item'";
        $result2 = mysqli_query($conn, $sql2);
        // echo $success;
        $sql4 = "UPDATE `inventory` SET `in_use` = '$inuse' WHERE `inventory`.`Item` = '$item'";
        $result4 = mysqli_query($conn,$sql4);
    }
}
$sql1 = "SELECT * FROM `issueditem` WHERE `item` = '$item' AND `employee` = '$emp'";
$result1 = mysqli_query($conn, $sql1);
$numrows = mysqli_num_rows($result1);
if($numrows==1){
    while($row1 = mysqli_fetch_assoc($result1)){
        $iniquan = $row1['quan'];
        $finquan = $iniquan+1;
        $sql3 = "UPDATE `issueditem` SET `quan` = '$finquan' WHERE `issueditem`.`item` = '$item' AND `issueditem`.`employee` = '$emp'";
        $result3 = mysqli_query($conn,$sql3);
    }
}

header('Location: employeedashboard.php')

?>