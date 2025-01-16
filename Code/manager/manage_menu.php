<?php include '../connect.php'; session_start()?>
<?php 
    if(isset($_SESSION['role'])){
        if(!($_SESSION['role'] == "manager")){
            header('location: ../index.php'); 
        }
    }else{
        header('location: ../index.php'); 
    }
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <title>Manage Menu</title>
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
                    <a type="button" data-te-ripple-init data-te-ripple-color="light" href="../employee/reservation_history.php"
                        class="mr-3 inline-block rounded bg-[#7a0118] px-8 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]">
                        reservation_history
                    </a>
                    <a type="button" data-te-ripple-init data-te-ripple-color="light" href="manage_time.php"
                        class="mr-3 inline-block rounded bg-[#7a0118] px-8 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]">
                        ManageTime
                    </a>
                </ul>
            </div>
        </div>
    </nav>


    <!-- เพิ่มเมนู -->
    <div id="Add" class="mx-auto flex mb-2 items-center pt-0">
        <div class="container mx-auto my-8 p-6 bg-white rounded-sm shadow-sm w-3/5">
            <h2 class="text-3xl font-semibold mb-4 text-center">ADD NEW MENU</h2>
            <div class="p-4">
                <!-- ใช้ Tailwind CSS เพื่อสร้างปุ่มและส่วนข้อมูล -->
                <button id="toggleButton" type="button"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center space-x-2 mx-auto">
                    <i id="icon" class="fas fa-plus"></i>
                    <!-- <span>กดเพื่อซ่อน/แสดงข้อมูล</span> -->
                </button>
                <div id="hiddenContent" class="hidden mt-4 bg-gray-200 p-4 shadow-lg w-2/3 mx-auto">
                    <form enctype="multipart/form-data" action="insert_menu.php" method="post">
                        <div class="mb-4">
                            <label for="type" class="block text-sm text-gray-700 font-semibold">Type:</label>
                            <select id="type" name="category" class="border rounded-lg py-2 px-3 w-full">
                                <option value="Speciallity">Speciallity</option>
                                <option value="Appetizers">Appetizers</option>
                                <option value="Salads">Salads</option>
                                <option value="Main Courses">Main Courses</option>
                                <option value="Sides">Sides</option>
                                <option value="Desserts">Desserts</option>
                                <option value="Beverages">Beverages</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm text-gray-700 font-semibold">Name:</label>
                            <input type="text" name="food_name"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-indigo-500">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm text-gray-700 font-semibold">Description:</label>
                            <textarea id="describtion" cols="30" rows="5" name="details"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-indigo-500"></textarea>
                        </div>

                        <!-- กล่องอัปโหลดรูปภาพ -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-700 font-semibold">Upload Image:</label>
                            <label for="fileInput"
                                class="w-full flex flex-col items-center px-4 py-6 bg-white text-gray-700 rounded-lg shadow-md tracking-wide uppercase cursor-pointer hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 text-gray-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 3a.5.5 0 01.5.5V16a.5.5 0 01-1 0V3.5a.5.5 0 01.5-.5z"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd"
                                        d="M3.293 9.293a1 1 0 011.414 0L10 14.586l5.293-5.293a1 1 0 111.414 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base leading-normal">Select a file</span>
                                <input type='file' class="hidden" name="image" id="fileInput" accept="image/*" />
                            </label>
                        </div>
                            <div class="flex items-center justify-center">
                                <div class="w-full">
                                  <button class="w-full text-white bg-[#050708] hover:bg-[#050708]/90 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center justify-center mr-2 mb-2 cursor-pointer">
                                    <span class="text-center ml-2">Save</span>
                                  </button>
                                </div>
                              </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- ค้นหาอาหารจากไอดี -->
    <div class="container justify-center mx-auto py-2 w-60">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Name"
            class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-indigo-500">
    </div>


    <?php
        $query_menu = "SELECT food_id,food_name,image,category FROM menu";
        $result_menu = mysqli_query($connect, $query_menu)
    ?>
    <!-- ตารางแสดงอาหาร -->
    <div class="container flex justify-center py-5 mx-auto">
        <div class="flex flex-col">
            <div class="w-2/3 mx-auto">
                <div class="border-b border-gray-200 shadow">
                    <table class="divide-y divide-gray-300" id="myTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="w-1/5 px-6 py-2 text-sm text-gray-900">
                                    ID
                                </th>
                                <th class="w-1/5 px-6 py-2 text-sm text-gray-900">
                                    Type
                                </th>
                                <th class="w-1/5 px-6 py-2 text-sm text-gray-900">
                                    Menu
                                </th>
                                <th class="w-1/5 px-6 py-2 text-sm text-gray-900">

                                </th>
                                <th class="w-1/5 px-6 py-2 text-sm text-gray-900">

                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300 h-20">
                            <?php if(mysqli_num_rows($result_menu) > 0):?>
                                <?php while ($row = mysqli_fetch_assoc($result_menu)):?>
                                    <tr class="whitespace-nowrap">
                                        <td class="px-6 py-4 text-sm text-gray-500 text-center">
                                            <?php echo $row['food_id'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500 text-center">
                                                <?php echo $row['category'] ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500"><?php echo $row['food_name'] ?></div>
                                        </td>
                                        <td>
                                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']) ?>">
                                        </td>
                                        <td class="px-6 py-4 text-center align-middle">
                                            <button onclick="showConfirmDelete('<?php echo $row['food_id'] ?>')" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                    <form action="deletemenu.php" method="post" id="deletemenu">
                        <input type="hidden" id="food_id" name="food_id">
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div id="Add" class="hidden mx-auto flex mb-2 items-center pt-0 w-2/3">
        <div class="container mx-auto my-8 p-6 bg-white rounded-lg shadow-lg">
            <div class="bg-gray-200 p-4 rounded-lg w-1/2 mx-auto">
            </div>
        </div>
    </div>


    <div id="Delete"
        class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-4 rounded-lg w-1/2">
            <h2 class="text-2xl font-semibold mb-4 text-center">Confirm Delete</h2>
            <p class="text-lg text-gray-700 font-semibold">Are you sure you want to delete this item?</p>
            <div class="flex justify-center mt-4">
                <button onclick="deleteItem()" type="button"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mx-2 rounded-lg">Delete</button>
                <button onclick="cancelDelete()" type="button"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 mx-2 rounded-lg">Cancel</button>
            </div>
        </div>
    </div>
</body>
<script>
    // แสดง Confirm Delete Box และส่งรายการที่ต้องการลบเข้าไปในตัวแปร currentDeleteItem
    function showConfirmDelete(item){
        currentDeleteItem = item;
        var Delete = document.getElementById('Delete');
        Delete.classList.remove('hidden');
    }

    // ยกเลิกการแสดง Confirm Delete Box
    function cancelDelete() {
        var Delete = document.getElementById('Delete');
        Delete.classList.add('hidden');
        currentDeleteItem = null;
    }

    // ลบรายการและปิด Confirm Delete Box
    function deleteItem() {
        if (currentDeleteItem) {
            document.getElementById('food_id').value = currentDeleteItem
            cancelDelete();
            document.getElementById('deletemenu').submit();
        }
    }
    </script>

    <!-- ค้นหาอาหารจากไอดี และ เมนูอาหาร-->
    <script>
        function myFunction() {
            var src, input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase().trim().split(' ');
            table = document.getElementById("myTable");
            for (j = 0; j < filter.length; j++) {
                tr = table.getElementsByTagName("tr");
                src = filter[j].trim();
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    td2 = tr[i].getElementsByTagName("td")[2];
                    if (src != '' && td && td2) {
                        txtValue = td.textContent || td.innerText;
                        txtValue2 = td2.textContent || td2.innerText;
                        if (txtValue.toUpperCase().indexOf(src) > -1 || txtValue2.toUpperCase().indexOf(src) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                    else {
                        tr[i].style.display = "";
                    }
                }
            }
        }

    var toggleButton = document.getElementById("toggleButton");
    var hiddenContent = document.getElementById("hiddenContent");
    var icon = document.getElementById("icon");

    toggleButton.addEventListener("click", function () {
        if (hiddenContent.classList.contains("hidden")) {
            hiddenContent.classList.remove("hidden");
            icon.classList.remove("fa-plus");
            icon.classList.add("fa-minus");
        }else{
            hiddenContent.classList.add("hidden");
            icon.classList.remove("fa-minus");
            icon.classList.add("fa-plus");
            }
        });
    </script>
<?php mysqli_close($connect); ?>
</html>