<?php include '../connect.php'; session_start();?>

<?php
    if(isset($_POST)){
        $time = $_POST['time'];
        $people = $_POST["people"];
        $tableArry = $_POST['table'];
    }

    //เช็ค empty
    if (empty($time)){
        setcookie("error", "date and time is required!", time() + (5), "/");
        header('location: reservation.php');
    }elseif(empty($people)){
        setcookie("error", "people is required!", time() + (5), "/");
        header('location: reservation.php');
    }elseif(empty($tableArry)){
        setcookie("error", "table is required!", time() + (5), "/");
        header('location: reservation.php');
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
            if(in_array($tableArry[$i], $reser_table, true)){
                array_push($errors, "โต๊ะที่เลือกถูกจองไปก่อนแล้ว");
                break;
            }
            $unit_table += $table_prson[$tableArry[$i][0]];
        }

        //เช็คโต๊ะจองไปยัง
        if(count($errors) > 0){
            setcookie("error", "This table has already been duly reserved!", time() + (5), "/");
            header('location: reservation.php');
        }else{
            
            $limit = 70;
            if($people == 1){
            $limit = 50;
            }

            if(round($people*100/$unit_table) < $limit){
                setcookie("error", "The number of people is fewer than the required minimum!", time() + (5), "/");
                header('location: reservation.php');
            }elseif(($people/$unit_table) > 1){
                setcookie("error", "The number of people exceeds the available seats!", time() + (5), "/");
                header('location: reservation.php');
            }else{
                $query_reser = "SELECT booking_id FROM reservations";
                $result_reser = mysqli_query($connect, $query_reser);
                $num_row = mysqli_num_rows($result_reser);
                
                $booking_id = mysqli_real_escape_string($connect,"BOOK-".($num_row+1));
                $username = mysqli_real_escape_string($connect,$_SESSION['user_name']);
                $people_count = mysqli_real_escape_string($connect,$people);
                $time_id = mysqli_real_escape_string($connect,$time);
                $price = $people_count * 1390;

                $insert = "INSERT INTO reservations(booking_id, user_name, people_count, price, time_id) 
                            VALUES ('$booking_id', '$username', '$people_count', '$price', '$time_id');";
                mysqli_query($connect, $insert);

                for ($i = 1; $i < count($tableArry); $i++){
                    $table_code = mysqli_real_escape_string($connect,$tableArry[$i]);
                    $insert_table = "INSERT INTO reserve_table(booking_id, number_table) 
                            VALUES ('$booking_id','$table_code');";
                    mysqli_query($connect, $insert_table);
                }

                $foodString = $_POST['food_db'];
                $foodArray = json_decode($foodString, true);

                if(strlen($foodString) > 0){
                    for ($i = 0; $i < count($foodArray); $i++){
                        $food_id = mysqli_real_escape_string($connect,$foodArray[$i]['name']);
                        $food_quantity = mysqli_real_escape_string($connect,$foodArray[$i]['quantity']);
                        $insert_food = "INSERT INTO food_orders(booking_id, food_id,quantity) 
                                    VALUES ('$booking_id','$food_id','$food_quantity');";
                        mysqli_query($connect, $insert_food);
                    }
                }
                
                function generate_booking_code($length = 5, $codeArraydb = []){
                    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $code = '';
                    do {
                        $code = '';
                        for ($i = 0; $i < $length; $i++) {
                            $code .= $characters[rand(0, strlen($characters) - 1)];
                        }
                    } while (in_array($code, $codeArraydb));
                    return $code;
                }

                $codeArraydb = array();
                $query_c_book = "SELECT booking_code FROM inspection";
                $result_c_book = mysqli_query($connect, $query_c_book);

                if(mysqli_num_rows($result_table) > 0){
                    while($row = mysqli_fetch_assoc($result_c_book)){
                        array_push($codeArraydb, $row['booking_code']);
                    }
                }

                $booking_code = generate_booking_code(5, $codeArraydb);

                $insert_c_book = "INSERT INTO inspection(booking_code, booking_id) 
                                VALUES ('$booking_code','$booking_id');";
                mysqli_query($connect, $insert_c_book);

                $update_c_book = "UPDATE reservations SET booking_code = '$booking_code' WHERE booking_id = '$booking_id'";
                mysqli_query($connect, $update_c_book);
                mysqli_close($connect);
                header('location: reservation_user.php');
            }
        }
    }
?>
