<?php include '../connect.php'; session_start();?>
<?php 
    if(isset($_SESSION['role'])){
        if($_SESSION['role'] == "chef"){
            header('location: index.php'); 
        }
    }else{
        header('location: index.php'); 
    }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation history</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
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
                class="block border-0 bg-transparent px-2 text-neutral-500 hover:no-underline hover:shadow-none focus:no-underline focus:shadow-none focus:outline-none focus:ring-0  lg:hidden"
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
                    <!-- Home link -->
                    <?php if($_SESSION['role'] == "employee"):?>
                    <a type="button" data-te-ripple-init data-te-ripple-color="light" href="reservation_verify.php"
                        class="mr-3 inline-block rounded bg-[#7a0118] px-8 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]">
                        reservation_verify
                    </a>
                    <?php endif ?>
                    
                    <?php if($_SESSION['role'] == "manager"):?>
                        <a type="button" data-te-ripple-init data-te-ripple-color="light" href="../manager/manage_menu.php"
                        class="mr-3 inline-block rounded bg-[#7a0118] px-8 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]">
                        ManageMenu
                    </a>
                    <a type="button" data-te-ripple-init data-te-ripple-color="light" href="../manager/manage_time.php"
                        class="mr-3 inline-block rounded bg-[#7a0118] px-8 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]">
                        ManageTime
                    </a>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <form action ="reservation_history.php" method="get">
    <div class="container mx-auto my-8 p-6 bg-white rounded-lg shadow-lg">
        <div class="flex space-x-4">
            <div class="w-2/5">
                <label for="date" class="block font-semibold text-gray-800">วันที่:</label>
                <input type="date" id="date" name="date" class="border rounded-lg py-2 px-3 w-full" value="<?php if(isset($_GET['date'])){
                    echo $_GET['date'];
                } ?>">
            </div>
            <div class="w-2/5">
                <label for="time" class="block font-semibold text-gray-800">เวลา:</label>
                <select id="time" name="time" class="border rounded-lg py-2 px-3 w-full">
                    <?php
                        if(isset($_GET['date'])){
                            $data = $_GET['date'];
                            $query_time = "SELECT * FROM table_time WHERE day = '$data'";
                            $result_time = mysqli_query($connect, $query_time);
                            if(mysqli_num_rows($result_time) > 0){
                                while($row = mysqli_fetch_assoc($result_time)){
                                    if($_GET['time'] == $row['time_id']){
                                        echo "<option value=\"{$row['time_id']}\" selected>{$row['start_time']} - {$row['end_time']}</option>";
                                    }else{
                                        echo "<option value=\"{$row['time_id']}\">{$row['start_time']} - {$row['end_time']}</option>";
                                    }
                                }
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="w-1/5 flex justify-start items-center">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">Enter</button>
            </div>
        </div>

        <?php
        $query_time_all = "SELECT * FROM table_time";
        $result_time_all = mysqli_query($connect, $query_time_all);

        if(mysqli_num_rows($result_time_all) > 0){
            while($row = mysqli_fetch_assoc($result_time_all)){
                $datetime[] = array(
                    "id" => $row['time_id'],
                    "day" => $row['day'],
                    "start_time" => $row['start_time'],
                    "end_time" => $row['end_time']
                );
            }
        }else{
            $datetime[] = array();
        }
    ?>

    <script>
        //แสดงเพิ่ม option เวลา ของวันที่นั้น โดยดึงข้อมูล database
        var datetime = <?php echo json_encode($datetime); ?>;
        document.getElementById("date").addEventListener("change", Time)
        function Time(){
                var selectedDate = document.getElementById("date").value;
                var select = document.getElementById("time");
                                            
                while (select.firstChild){
                    select.removeChild(select.firstChild);
                }

                for (var i = 0; i < datetime.length; i++){
                    if(datetime[i].day == selectedDate){
                        var duration = datetime[i].start_time +' - '+ datetime[i].end_time
                        var option = document.createElement("option");
                        option.value = datetime[i].id
                        option.text = duration
                        select.appendChild(option);
                    }
                }
        }
    </script>

    
    <?php if(isset($_GET['time'])):?>
        <?php
            $time_id = $_GET['time'];
            $query_reser = "SELECT booking_id, user_name, people_count,price FROM reservations WHERE time_id = '$time_id'";
            $result_reser = mysqli_query($connect, $query_reser);
        ?>

        <div>
            <table class="table-auto w-full">
                <caption class="font-semibold text-xl">All Reservation Details</caption>
                <br>
                <thead>
                    <tr class="bg-indigo-200 text-center">
                        <th class="px-4 py-2 w-1/6">ReservationNumber</th>
                        <th class="px-4 py-2 w-1/6">Customer Name</th>
                        <th class="px-4 py-2 w-1/6">Guests</th>
                        <th class="px-4 py-2 w-1/6">price</th>
                        <th class="px-4 py-2 w-1/3">Table</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result_reser)):?>
                    <tr class="text-center">
                        <td class="border px-4 py-2"><?php echo $row['booking_id']?></td>
                        <td class="border px-4 py-2"><?php echo $row['user_name']?></td>
                        <td class="border px-4 py-2"><?php echo $row['people_count']?></td>
                        <td class="border px-4 py-2"><?php echo $row['price']?></td>
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
                    <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif ?>
    <?php mysqli_close($connect); ?>                       
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>

</html>