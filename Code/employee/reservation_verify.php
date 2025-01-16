<?php include '../connect.php'; session_start();?>
<?php
    if(isset($_SESSION['role'])){
        if(!($_SESSION['role'] == "employee")){
            header('location: ../index.php'); 
        }
    }else{
        header('location: ../index.php'); 
    }
?>

<?php
    date_default_timezone_set("Asia/Bangkok");
    $today = date("Y-m-d");
    $timeday = date("H:i:s");

    $query_belate = "SELECT booking_id FROM reservations JOIN table_time USING (time_id) JOIN inspection USING (booking_id) WHERE day < '{$today}' and Status ='NOT USED'";
    $result_belate = mysqli_query($connect, $query_belate);

    $query_belate2 = "SELECT booking_id FROM reservations JOIN table_time USING (time_id) JOIN inspection USING (booking_id) WHERE day = '{$today}' and end_time < '{$timeday}' and Status ='NOT USED'";
    $result_belate2 = mysqli_query($connect, $query_belate2);
    
    $belatearray = array();

    if(mysqli_num_rows($result_belate) > 0){
        while($row_belate = mysqli_fetch_assoc($result_belate)){
            array_push($belatearray, $row_belate['booking_id']);
        }
    }

    if(mysqli_num_rows($result_belate2) > 0){
        while($row_belate2 = mysqli_fetch_assoc($result_belate2)){
            array_push($belatearray, $row_belate2['booking_id']);
        }
    }

    //การจองอันไหนเลยเวลาแต่ยังไม่ใช้งานให้เปลี่ยนเป็น BE LATE
    if(count($belatearray) > 0){
        foreach ($belatearray as $belate) {
            $update_inspec = "UPDATE inspection SET Status = 'BE LATE' WHERE booking_id = '{$belate}'";
            mysqli_query($connect, $update_inspec);
        }
    }

    //ตรวจสอบการจอง
    if(isset($_GET['booking_code'])){
        $booking_code = $_GET['booking_code'];
        $query_resertime = "SELECT day,start_time FROM reservations JOIN table_time USING (time_id) WHERE booking_code = '{$booking_code}'";
        $result_resertime = mysqli_query($connect, $query_resertime);
        $row_resertime = mysqli_fetch_assoc($result_resertime);

        $query_Status = "SELECT Status FROM inspection WHERE booking_code = '{$booking_code}'";
        $result_Status = mysqli_query($connect, $query_Status);
        $row_Status = mysqli_fetch_assoc($result_Status);

        $status = $row_Status['Status'];
        $day = $row_resertime['day'];
        $start_time = $row_resertime['start_time'];

        $timeday15 = date("H:i:s", strtotime('+15 minutes'));
        if(mysqli_num_rows($result_resertime) == 0) {
            setcookie("error", "This code does not exist.", time() + (5), "/");
            setcookie("booking_code", $booking_code, time() + (5), "/");
            header('location: reservation_verify.php');
        }elseif($today < $day){
            setcookie("error", "It\'s not time yet.", time() + (5), "/");
            setcookie("booking_code", $booking_code, time() + (5), "/");
            header('location: reservation_verify.php');
        }elseif($status == "BE LATE"){
            setcookie("error", "You are too late.", time() + (5), "/");
            setcookie("booking_code", $booking_code, time() + (5), "/");
            header('location: reservation_verify.php');
        }elseif($today == $day && $start_time > $timeday15){
            setcookie("error", "It\'s not time yet.", time() + (5), "/");
            setcookie("booking_code", $booking_code, time() + (5), "/");
            header('location: reservation_verify.php');
        }elseif($status == "USED"){
            setcookie("error", "This code has already been used.", time() + (5), "/");
            setcookie("booking_code", $booking_code, time() + (5), "/");
            header('location: reservation_verify.php');
        }elseif($status == "NOT USED"){
            $update_inspec = "UPDATE inspection SET Status = 'USED' WHERE booking_code = '{$booking_code}'";
            mysqli_query($connect, $update_inspec);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    sans: ["Roboto", "sans-serif"],
                    body: ["Roboto", "sans-serif"],
                    mono: ["ui-monospace", "monospace"],
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>
</head>

<body class="bg-gray-100">

<?php if(isset($_COOKIE["booking_code"])):?>
    <script>
        Swal.fire({
            title: '<?php echo $_COOKIE["booking_code"];?>',
            text: '<?php echo $_COOKIE["error"];?>',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif ?>


    <!-- Main navigation container -->
    <nav class="sticky top-0 z-10 w-full flex-wrap items-center justify-between bg-[#0f0e0c] py-2 text-neutral-500 shadow-lg hover:text-neutral-700 focus:text-neutral-700 lg:py-4"
        data-te-navbar-ref>
        <div class="flex w-full flex-wrap items-center justify-between px-3">
            <div>
                <a class="mx-2 my-1 flex font-bold items-center text-white lg:mb-0 lg:mt-0" href="../index.php">
                    <img class="w-[70px]" src="../images/logo.png" alt="Logo" loading="lazy" /><span>RUBY BUFFET</span>
                </a>
            </div>

            <!-- Hamburger button for mobile view -->
            <button
                class="block border-0 bg-transparent px-2 text-neutral-500 hover:no-underline hover:shadow-none focus:no-underline focus:shadow-none focus:outline-none focus:ring-0 lg:hidden"
                type="button" data-te-collapse-init data-te-target="#navbarSupportedContent4"
                aria-controls="navbarSupportedContent4" aria-expanded="false" aria-label="Toggle navigation">
                <!-- Hamburger icon -->
                <span class="[&>svg]:w-7">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-7 w-7">
                        <path fill-rule="evenodd"
                            d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </button>

            <!-- Collapsible navbar container -->
            <div class="!visible mt-2 hidden flex-grow basis-[100%] items-center lg:mt-0 lg:!flex lg:basis-auto"
                id="navbarSupportedContent4" data-te-collapse-item>
                <!-- Left links -->
                <ul class="list-style-none ml-auto flex flex-col pl-0 lg:mt-1 lg:flex-row" data-te-navbar-nav-ref>
                    <a type="button" data-te-ripple-init data-te-ripple-color="light" href="reservation_history.php"
                        class="mr-3 inline-block rounded bg-[#7a0118] px-8 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]">
                        Reservation_history
                    </a>
                </ul>

            </div>
        </div>
    </nav>
    
    <div class="container mx-auto my-8 p-6 bg-white rounded-lg shadow-lg">
        <div class="w-1/2 mx-auto">
            <form class="text-center" action= "reservation_verify.php" method="get">
                <div class="flex mb-3 items-center">
                    <label for="re_num"
                        class="block text-lg text-gray-700 font-semibold mr-2">ReservationNumber:</label>
                    <input type="text" id="booking_code" name="booking_code" 
                        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-indigo-500" required/>
                </div>

                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">Enter</button>
                <a href="qrscan.html" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">QRscanner<a>
            </form>
        </div>
        
        <?php if(isset($_GET['booking_code'])):?>
        <?php
            $query_reser = "SELECT * FROM reservations JOIN member USING (user_name) WHERE booking_code = '$booking_code'";
            $result_reser = mysqli_query($connect, $query_reser);
        ?>
            <div id="customer_detail" class="mt-6">
                <table class="table-auto w-full">
                    <caption class="font-semibold text-xl">Reservation Details</caption>
                    <br>
                    <tbody>
                    <?php while($row = mysqli_fetch_assoc($result_reser)):?>
                        <tr>
                            <td class="border px-2 py-2 w-1/3">Reservation Number:</td>
                            <td class="border px-4 py-2"><?php echo $row['booking_id']; ?></td>
                        </tr>
                        <tr>
                            <td class="border px-2 py-2 w-1/3">Name:</td>
                            <td class="border px-4 py-2"><?php echo $row['first_name'].$row['last_name']; ?></td>
                        </tr>
                        <tr>
                            <td class="border px-2 py-2 w-1/3">Guests</td>
                            <td class="border px-4 py-2"><?php echo $row['people_count']; ?></td>
                        </tr>
                        <tr>
                            <td class="border px-2 py-2 w-1/3">Table:</td>
                            <td class="border px-4 py-2">
                                <?php
                                    $booking_id = $row['booking_id'];
                                    $query_table = "SELECT booking_id, number_table FROM reservations JOIN reserve_table 
                                    USING (booking_id) WHERE booking_id = '$booking_id'";
                                    $result_table = mysqli_query($connect, $query_table);

                                    while ($row_table = mysqli_fetch_array($result_table)){
                                        echo $row_table['number_table']." ";
                                    }
                                ?>  
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-2 py-2 w-1/3">Reservation Code:</td>
                            <td class="border px-4 py-2"><?php echo $booking_code ?></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
        <?php endif ?>
    </div>
</body>
<?php mysqli_close($connect); ?>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</html>