<?php include '../connect.php';?>

<?php 
    if(isset($_POST)){
        $date = mysqli_real_escape_string($connect, $_POST['date']);
        $s_time = mysqli_real_escape_string($connect, $_POST['s_time']);
        $e_time = mysqli_real_escape_string($connect, $_POST['e_time']);

        $query_time = "SELECT start_time, end_time FROM table_time WHERE day = '{$date}'";
        $result_time = mysqli_query($connect, $query_time);

        $array_time = array();
        if(mysqli_num_rows($result_time) > 0){
            while($row = mysqli_fetch_assoc($result_time)){
                array_push($array_time, $row['start_time']);
                array_push($array_time, $row['end_time']);
            }
        }

        if(in_array($s_time, $array_time, true)){
            header("location: manage_time.php?date={$date}");
        }elseif(in_array($e_time, $array_time, true)){
            header("location: manage_time.php?date={$date}");
        }elseif($s_time === $e_time){
            header("location: manage_time.php?date={$date}");
        }else{
            $insert_time = "INSERT INTO table_time(day, start_time, end_time) 
            VALUES ('$date','$s_time','$e_time');";
            mysqli_query($connect, $insert_time);
            header("location: manage_time.php?date={$date}");
        }
    }
    mysqli_close($connect);
?>