<?php include '../connect.php'; session_start();?>
<?php 
    if(isset($_SESSION['role'])){
        if(!($_SESSION['role'] == "manager")){
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <title>Manage Time</title>
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
                    <!-- Home link -->
                    <a type="button" data-te-ripple-init data-te-ripple-color="light" href="manage_menu.php"
                        class="mr-3 inline-block rounded bg-[#7a0118] px-8 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]">
                        ManageMenu
                    </a>
                    <a type="button" data-te-ripple-init data-te-ripple-color="light" href="../employee/reservation_history.php"
                        class="mr-3 inline-block rounded bg-[#7a0118] px-8 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]">
                        reservation_history
                    </a>
                </ul>
            </div>
        </div>
    </nav>

    <h1 class="text-4xl font-semibold mb-4 text-center mx-1/3 p-10">TIME MANAGEMENT</h1>

    <form id= "formdate" method="get">
        <div class="w-1/2 items-center text-center container mx-auto">
            <label for="date" class="block font-semibold text-gray-800">Date:
                <input type="date" id="date" name="date" class="border rounded-lg py-2 px-3 w-1/2" value="<?php if(isset($_GET['date'])){
                    echo $_GET['date'];
                } ?>">
            </label>
        </div>
    </form>

    <script>
        document.getElementById("date").addEventListener("change", function() {
            document.getElementById("formdate").submit()
        })
    </script>

    
    <?php 
        if(isset($_GET['date'])){
            $data = $_GET['date'];
            $query_time = "SELECT * FROM table_time WHERE day = '$data' ORDER BY start_time asc";
            $result_time = mysqli_query($connect, $query_time);
        }
    ?>

    <div class="flex container mx-auto my-4 space-x-4">
        <div class="w-1/2">
            <div class="w-full my-4 p-6 bg-white rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-center mx-1/3 p-2">ลบรอบเวลา</h2>
                <?php if(isset($result_time)):?>
                    <?php if(mysqli_num_rows($result_time) > 0): ?>
                        <form action = "deletetime.php" method="post" id="formtime">
                            <div class="mb-4">
                                <label for="time" class="block text-xl font-bold transform translate-x-[10%]">รอบเวลา:</label>
                                <div class="bg-gray-200 p-4 rounded-lg w-3/5 mx-auto transform translate-x-[15%]">
                                    <?php while($row = mysqli_fetch_assoc($result_time)):?>
                                        <div class="time-range flex justify-between items-center mb-2">
                                            <span class="font-bold"><?php echo $row['start_time']." - ".$row['end_time'] ?></span>
                                            <button type="button" onclick="delete_time('<?php echo $row['time_id'] ?>')" class="inline-flex items-center justify-center w-8 h-8 mr-2 text-pink-100 transition-colors duration-150 bg-pink-700 rounded-full focus:shadow-outline hover:bg-pink-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    <?php endwhile?>
                                </div>
                            </div>
                                <input type="hidden" name="time" id="time">
                                <input type="hidden" name="date" id="datepost">
                        </form>
                    <?php endif?>
                <?php endif?>
            </div>
        </div>
        <script>
            function delete_time(time){
                document.getElementById("time").value = time;
                document.getElementById("datepost").value = document.getElementById("date").value;
                document.getElementById("formtime").submit();
            }
        </script>


        <div class="w-1/2">
            <div class="w-full my-4 p-6 bg-white rounded-lg shadow-lg text-center">
                <h2 class="text-2xl font-semibold text-center mx-1/3 p-2">เพิ่มรอบเวลา</h2>
                <form action= "insert_time.php" method="post" id="insert">
                    <div class="items-center container mx-auto">
                        <label for="date" class="block font-semibold text-gray-800">รอบเวลา:
                            <input type="time" id="s_time" name="s_time" min="09:00" max="18:00" required/> ถึง
                            <input type="time" id="e_time" name="e_time" min="09:00" max="18:00" required/>
                        </label>
                        <button onclick="showTable('Save')" type="button"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 mt-4 mx-2 rounded-lg">SAVE</button>
                    </div>
                    <input type="hidden" name="date" id="datesave">
                </form>
            </div>
        </div>

        <div id="Save" class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-4 rounded-lg w-1/2">
                <h2 class="text-2xl font-semibold mb-4 text-center">Confirm Save</h2>
                <p class="text-lg text-gray-700 font-semibold">Are you sure you want to add this item?</p>
                <div class="flex justify-center mt-4">
                    <button onclick="saveItem()" type="button" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 mx-2 rounded-lg">Save</button>
                    <button onclick="cancelDelete()" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 mx-2 rounded-lg">Cancel</button>
                </div>
            </div>
        </div>
    </div> 
</body>
<script>
    // ฟังก์ชันเรียกขึ้นตอนที่คลิกที่ปุ่ม "SAVE"
    function showTable(confirmId) {
        // แสดงหน้าต่างยืนยันการเพิ่ม
        var confirmBox = document.getElementById(confirmId);
        confirmBox.classList.remove('hidden');
    }

    // ฟังก์ชันเมื่อคลิกที่ปุ่ม "Delete"
    function saveItem() {
        // ทำงานเพิ่มรอบเวลาได้ที่นี่
        // เมื่อเสร็จสิ้น ซ่อนหน้าต่างยืนยันการเพิ่ม
        var confirmBox = document.getElementById('Save');
        confirmBox.classList.add('hidden');
        document.getElementById('datesave').value = document.getElementById("date").value;
        document.getElementById("insert").submit();
        // เพิ่มรอบเวลาเรียบร้อยแล้ว คุณสามารถทำตรรกะของคุณที่นี่
    }

        // ฟังก์ชันเมื่อคลิกที่ปุ่ม "Cancel"
    function cancelDelete() {
        // ซ่อนหน้าต่างยืนยันการเพิ่ม
        var confirmBox = document.getElementById('Save');
        confirmBox.classList.add('hidden');

        // คุณสามารถทำอะไรก็ตามที่คุณต้องการเมื่อยกเลิกการเพิ่มที่นี่
    }
</script>
<?php mysqli_close($connect); ?>
</html>