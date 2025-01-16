<?php include '../connect.php'; session_start();?>

<?php 
    if(isset($_SESSION['role'])){
        if(!($_SESSION['role'] == "chef")){
            header('location: ../index.php'); 
        }
    }else{
        header('location: ../index.php'); 
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>food orders</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
    <style>
        * {
            font-family: 'Gabarito', cursive;
        }
    </style>
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
        </div>
    </nav>

    <div class="container mx-auto my-8 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold mb-4">Search</h1>

        <form action = "foodorders.php" method="get" class="space-y-4">
            <div class="flex space-x-4">
                <div class="w-1/2">
                    <label for="date" class="block font-semibold text-gray-800">วันที่:</label>
                    <input type="date" id="date" name="date" class="border rounded-lg py-2 px-3 w-full" value="<?php if(isset($_GET['date'])){
                    echo $_GET['date'];
                } ?>">
                </div>
                <div class="w-1/2">
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
            </div>

            <label for="foodType" class="block font-semibold text-gray-800">ประเภทรายการอาหาร:</label>
            <select id="category" name="category" class="border rounded-lg py-2 px-3 w-full">
                <option value="Speciality">Speciality</option>
                <option value="Appetizers">Appetizers</option>
                <option value="Salads">Salads</option>
                <option value="Main Courses">Main Courses</option>
                <option value="Sides">Sides</option>
                <option value="Desserts">Desserts</option>
                <option value="Beverages">Beverages</option>
            </select>

            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">Submit</button>
        </form>

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

            <?php 
                if(isset($_GET['category'])){   
                    echo 'document.getElementById("category").value = "'. $_GET['category'] .'";';  
                }                  
            ?>
        </script>
        
        <div class="my-8 space-y-4">
            <button onclick="showTable('Detail')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Detail
            </button>
            <button onclick="showTable('Order')"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                Order
            </button>
        </div>


        <?php if(isset($_GET['time'])):?>
            <?php
                $time_id = $_GET['time'];
                $category = $_GET['category'];
                $query_orders = "SELECT booking_id,first_name, last_name, food_name, quantity FROM reservations JOIN member USING (user_name) 
                JOIN food_orders USING (booking_id) JOIN menu USING (food_id) WHERE time_id = '{$time_id}' and category = '{$category}'";
                $result_orders = mysqli_query($connect, $query_orders);
            ?>
        <table id="Detail" class="hidden table-auto w-full">
            <caption class="font-semibold text-xl">Details</caption>
            <thead>
                <tr class="bg-indigo-200">
                    <th class="px-4 py-2">ชื่อลูกค้า</th>
                    <th class="px-4 py-2">โต๊ะ</th>
                    <th class="px-4 py-2">รายการอาหาร</th>
                    <th class="px-4 py-2">จำนวน</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result_orders) > 0):?>
                    <?php while($row = mysqli_fetch_assoc($result_orders)):?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo $row['first_name']." ". $row['last_name'];?></td>
                            <td class="border px-4 py-2">
                            <?php
                                $booking_id = $row['booking_id'];
                                $query_table = "SELECT number_table FROM reservations JOIN reserve_table USING (booking_id) 
                                WHERE booking_id = '$booking_id'";
                                $result_table = mysqli_query($connect, $query_table);
                                while($row_table = mysqli_fetch_assoc($result_table)){
                                    echo $row_table['number_table']." ";
                                }
                            ?>
                            </td>
                            <td class="border px-4 py-2"><?php echo $row['food_name'];?></td>
                            <td class="border px-4 py-2"><?php echo $row['quantity'];?></td>
                        </tr>
                    <?php endwhile ?>
                <?php endif?>
            </tbody>
        </table>
            
        <?php 
            $query_orders_all = "SELECT food_name, SUM(quantity)`sum_quantity` FROM food_orders JOIN reservations USING (booking_id) JOIN menu
            USING (food_id) WHERE time_id = '{$time_id}' and category = '{$category}' GROUP BY food_id";
            $result_orders_all = mysqli_query($connect, $query_orders_all);
        ?>

        <table id="Order" class="hidden table-auto w-full">
            <caption class="font-semibold text-xl">Orders</caption>
            <thead>
                <tr class="bg-green-200">
                    <th class="px-4 py-2">รายการอาหาร</th>
                    <th class="px-4 py-2">จำนวนรายการอาหารทั้งหมด</th>
                </tr>
            </thead>
            <tbody class="text-center">
            <?php if(mysqli_num_rows($result_orders_all) > 0):?>
                <?php while($row = mysqli_fetch_assoc($result_orders_all)):?>
                <tr>
                    <td class="border px-4 py-2"><?php echo $row['food_name'];?></td>
                    <td class="border px-4 py-2"><?php echo $row['sum_quantity'];?></td> 
                </tr>
                <tr>
                <?php endwhile ?>
            <?php endif?>
            </tbody>
        </table>
    </div>
    <?php endif ?>
</body>
<script>
        function showTable(tableId) {
            var Detail = document.getElementById('Detail');
            var Order = document.getElementById('Order');

            if (tableId === 'Detail') {
                Detail.classList.remove('hidden');
                Order.classList.add('hidden');
            } else if (tableId === 'Order') {
                Detail.classList.add('hidden');
                Order.classList.remove('hidden');
            }
        }
</script>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
<?php mysqli_close($connect); ?>
</html>