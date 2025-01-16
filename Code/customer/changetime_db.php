<?php include '../connect.php'; session_start();?>

<?php
    $booking_id = $_POST['booking_id'];
    $time = $_POST['time'];
    $tableArry = $_POST["table".$booking_id];
    $people = $_POST['people'];


    if (empty($time)){
        setcookie("error", "date and time is required!", time() + (5), "/");
        header('location: reservation_user.php');
    }elseif(empty($tableArry)){
        setcookie("error", "table is required!", time() + (5), "/");
        header('location: reservation_user.php');
    }else{
        $errors = array();
        
        $reser_table = array();
        $query_table = "SELECT time_id,number_table FROM reservations JOIN reserve_table 
        USING (booking_id) JOIN table_time USING (time_id) WHERE time_id = '$time'";
        $result_table = mysqli_query($connect, $query_table);

        if(mysqli_num_rows($result_table) > 0){
            while($row = mysqli_fetch_assoc($result_table)){
                array_push($reser_table, $row['number_table']);
            }
        }

        $table_prson = array(
            "A" => 2,
            "B" => 4,
            "C" => 6
        );
    
        $unit_table = 0;

        for ($i = 1; $i < count($tableArry); $i++){
            if (in_array($tableArry[$i], $reser_table, true)){
                array_push($errors, "โต๊ะที่เลือกถูกจองไปก่อนแล้ว");
                break;
            }
            $unit_table += $table_prson[$tableArry[$i][0]];
        }

        if(count($errors) > 0){
            setcookie("error", "This table has already been duly reserved!", time() + (5), "/");
            header('location: reservation_user.php');
        }else{
            $limit = 70;
            if($people == 1){
                $limit = 50;
            }
            
            if(round($people*100/$unit_table) < $limit){
                setcookie("error", "The number of people is fewer than the required minimum!", time() + (5), "/");
                header('location: reservation_user.php');
            }elseif(($people/$unit_table) > 1){
                setcookie("error", "The number of people exceeds the available seats!", time() + (5), "/");
                header('location: reservation_user.php');
            }else{
                $delete_table = "DELETE FROM reserve_table WHERE booking_id = '$booking_id';";
                mysqli_query($connect, $delete_table);
        
                for ($i = 1; $i < count($tableArry); $i++){
                    $table_code = mysqli_real_escape_string($connect,$tableArry[$i]);
                    $insert_table = "INSERT INTO reserve_table(booking_id, number_table) 
                            VALUES ('$booking_id','$table_code');";
                    mysqli_query($connect, $insert_table);
                }
        
                $update_reser = "UPDATE reservations SET time_id = '$time' WHERE booking_id = '$booking_id'";
                mysqli_query($connect, $update_reser);
                header('location: reservation_user.php');
            }
        }
    }
    mysqli_close($connect);
?>