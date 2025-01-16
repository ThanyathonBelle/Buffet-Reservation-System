<?php include '../connect.php';?>

<?php 
    if(isset($_POST)){
        $date = $_POST['date'];
        $time_id = $_POST['time'];
        $delete_time = "DELETE FROM table_time WHERE time_id = '{$time_id}'";
        mysqli_query($connect, $delete_time);
        header("location: manage_time.php?date={$date}");
    }
    mysqli_close($connect);
?>