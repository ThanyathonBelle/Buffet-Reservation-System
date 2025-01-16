<?php include '../connect.php'; session_start();
    if (!isset($_SESSION['user_name'])){
        header('location: ../login.php');
    }
?>

<?php
    $username = $_SESSION['user_name'];
    $query_member = "SELECT first_name,last_name,phone FROM member WHERE user_name = '$username'";
    $result_member = mysqli_query($connect, $query_member);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Gabarito:wght@500&family=Kanit:wght@300&family=Merriweather&family=Noto+Sans+Thai:wght@300&family=Playfair+Display:wght@500&family=Poppins:wght@300&family=Roboto+Condensed&family=Roboto:wght@300;400&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
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
    <style>
        * {
            font-family: 'Gabarito', cursive;
        }

        .swal2-popup {
            font-size: 1.5vw;
            max-width: 38vw;
            max-height: 38vw;
        }

        @media screen and (min-width: 1200px) {
        .swal2-popup{
                font-size: 16px;
                max-width: 420px;
                max-height: 420px;
            }
        }

        @media screen and (max-width: 700px) {
        .swal2-popup{
                font-size: 10px;
                max-width: 280px;
                max-height: 280px;
            }
        }
    </style>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css'>
</head>

<body class="bg-[#49111c]">
    
    <?php if(isset($_COOKIE["error"])):?>
        <script>
            Swal.fire({
                title: 'Change failed',
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
                    <!-- Home link -->
                    <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                        <a class="text-[#f2f4f3]  transition duration-150 ease-in-out hover:text-[#7a0118] focus:text-[#570111] lg:px-2"
                            aria-current="page" href="menu.php" data-te-nav-link-ref>Menu</a>
                    </li>
                </ul>

                <div class="flex items-center px-5">
                    <a type="button" data-te-ripple-init data-te-ripple-color="light" href="reservation.php"
                        class="mr-3 inline-block rounded bg-[#7a0118] px-8 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]">
                        Reservation
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- user main -->
    <div class="container my-12 mx-auto md:px-6">
        <!-- Section: Design Block -->
        <section class="mb-32 text-center">
            <h2 class="mb-32 text-3xl lg:text-6xl font-bold">
                <u class="text-white">USER</u>
            </h2>
            <div class="mb-24 md:mb-0">
                <div
                    class="sm:mx-auto sm:w-[400px] block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
                    <div class="flex justify-center">
                        <div class="flex justify-center -mt-[75px]">
                            <img src="https://render.fineartamerica.com/images/rendered/square-dynamic/small/images/artworkimages/mediumlarge/2/1-totoro-valentina-hramov.jpg"
                                class="mx-auto rounded-full shadow-lg w-[150px]" alt="Avatar" />
                        </div>
                    </div>
                    <div class="p-6">
                        <?php while ($row = mysqli_fetch_array($result_member)):?>
                        <h5 class="mb-4 text-lg font-bold"><?php echo $row['first_name'].' '.$row['last_name']; ?></h5>
                        <p class="mb-6"><?php echo $row['phone'];?></p>
                        <?php endwhile?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section: Design Block -->
    </div>

    <?php
        $query_reser = "SELECT booking_id,day,start_time,end_time,people_count,booking_code FROM reservations 
        JOIN table_time USING (time_id) WHERE user_name = '$username'";
        $result_reser = mysqli_query($connect, $query_reser);



        $query_table = "SELECT booking_id, number_table FROM reservations JOIN reserve_table 
        USING (booking_id) WHERE user_name = '$username'";
        $result_table = mysqli_query($connect, $query_table);

        date_default_timezone_set("Asia/Bangkok");
        $today = date("Y-m-d");
        $time2hr = date("H:i:s", strtotime('+2 hours'));
    ?>
    
    <!-- user reserve -->
    <section class="mb-20 py-10 lg:mx-5 bg-white lg:rounded-2xl">
        <div class="lg:container h-full px-auto mx-auto">
            <div class="font-semibold text-3xl lg:text-5xl mb-3 flex justify-center text-[#7a0118]">Reservation History</div>
            <div class="flex flex-col md:w-[1000px] mx-auto">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                        <form action = "changetime_db.php" method = "post" id="myform">
                            <table class="min-w-full text-left text-lg  font-medium">
                                <thead class="border-b font-medium">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">DATE</th>
                                        <th scope="col" class="px-6 py-4">TIME</th>
                                        <th scope="col" class="px-6 py-4">TABLE</th>
                                        <th scope="col" class="px-6 py-4">GUEST</th>
                                        <th scope="col" class="px-6 py-4">CODE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($row_reser = mysqli_fetch_array($result_reser)):?>
                                    <tr class="border-b">
                                            <td class="whitespace-nowrap px-6 py-4 font-medium" id="date[<?php echo $row_reser['booking_id'];?>]"><?php echo $row_reser['day'];?></td>
                                            <td class="whitespace-nowrap px-6 py-4" id="time[<?php echo $row_reser['booking_id'];?>]"><?php echo $row_reser['start_time']." - ".$row_reser['end_time'];?></td>
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <div id="table[<?php echo $row_reser['booking_id']?>]">
                                                    <?php $result_table = mysqli_query($connect, $query_table);?>
                                                    <?php while ($row_table = mysqli_fetch_array($result_table)):?>
                                                        <?php if($row_table['booking_id'] == $row_reser['booking_id']):?>
                                                            <?php echo $row_table['number_table']." ";?>
                                                        <?php endif ?>
                                                    <?php endwhile?>
                                                </div>
                                                <div style="display: none;" class="w-40" id="select_tableshow[<?php echo $row_reser['booking_id']?>]">
                                                    <select data-te-select-init data-te-select-placeholder="Select Table"
                                                        data-te-select-size="lg" multiple id="select_table[<?php echo $row_reser['booking_id']?>]" name="table<?php echo $row_reser['booking_id'];?>[]">
                                                    </select>
                                                </div>
                                            </td>
                                        <td class="whitespace-nowrap px-6 py-4"><?php echo $row_reser['people_count'] ?></td>
                                        
                                        <td class="whitespace-nowrap px-6 py-4"><button type="button" data-te-toggle="modal"
                                                data-te-target="#qr1" data-te-ripple-init><img
                                                    src="https://api.qrserver.com/v1/create-qr-code/?size=50x50&data=<?php echo $row_reser['booking_code'] ;?>"></button>
                                        </td>
                                        <?php if($row_reser['day'] > $today):?>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="flex justify-center">
                                                <button type="button" onclick="change('<?php echo $row_reser['booking_id'];?>','<?php echo $row_reser['day'];?>','<?php echo $row_reser['start_time'] ?>','<?php echo $row_reser['people_count'] ?>')" id="changebtn[<?php echo $row_reser['booking_id'];?>]"
                                                    class="mr-3 inline-block rounded bg-primary px-5 lg:px-10 py-2 text-md font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none">CHANGE</button>
                                                <button type="button" onclick="addvalue('<?php echo $row_reser['booking_id'];?>','<?php echo $row_reser['people_count'] ?>')" id="savebtn[<?php echo $row_reser['booking_id'];?>]" name="Change"
                                                    class="hidden mr-3 inline-block rounded bg-success px-5 lg:px-10 py-2 text-md font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none">Save</button>
                                                <button type="button" id="cancelbtn[<?php echo $row_reser['booking_id'];?>]" onclick="location.reload()" name="Cancle"
                                                    class="hidden inline-block rounded bg-danger px-5 lg:px-10 py-2 text-md font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none">Cancel</button>
                                            </div>
                                        </td>
                                        <?php endif?>

                                        <?php if($row_reser['day'] == $today && $row_reser['start_time'] > $time2hr):?>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="flex justify-center">
                                                <button type="button" onclick="change('<?php echo $row_reser['booking_id'];?>','<?php echo $row_reser['day'];?>','<?php echo $row_reser['start_time'] ?>','<?php echo $row_reser['people_count'] ?>')" id="changebtn[<?php echo $row_reser['booking_id'];?>]"
                                                    class="mr-3 inline-block rounded bg-primary px-5 lg:px-10 py-2 text-md font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none">CHANGE</button>
                                                <button type="button" onclick="addvalue('<?php echo $row_reser['booking_id'];?>','<?php echo $row_reser['people_count'] ?>')" id="savebtn[<?php echo $row_reser['booking_id'];?>]" name="Change"
                                                    class="hidden mr-3 inline-block rounded bg-success px-5 lg:px-10 py-2 text-md font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none">Save</button>
                                                <button type="button" id="cancelbtn[<?php echo $row_reser['booking_id'];?>]" onclick="location.reload()" name="Cancle"
                                                    class="hidden inline-block rounded bg-danger px-5 lg:px-10 py-2 text-md font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none">Cancel</button>
                                            </div>
                                        </td>
                                        <?php endif?>

                                    </tr>
                                    <div data-te-modal-init
                                        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                                        id="qr1" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
                                        aria-modal="true" role="dialog">
                                        <div data-te-modal-dialog-ref
                                            class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[300px]">
                                            <div
                                                class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none">
                                                <div>
                                                    <img class="h-96 w-full rounded-t-lg object-cover md:h-auto md:!rounded-none md:!rounded-l-lg"
                                                        src="https://api.qrserver.com/v1/create-qr-code/?size=50x50&data=<?php echo $row_reser['booking_code'] ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                                <input type="hidden" name="booking_id" id="booking_id">
                                <input type="hidden" name="people" id="people">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>

<?php
    date_default_timezone_set("Asia/Bangkok");
    $today = date("Y-m-d");
    $query_time = "SELECT * FROM table_time WHERE day >= '{$today}'";
    $result_time = mysqli_query($connect, $query_time);

    if(mysqli_num_rows($result_time) > 0){
        while($row = mysqli_fetch_assoc($result_time)){
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
    var datetime = <?php echo json_encode($datetime); ?>;
    var arrayday = []
    for(var i = 0; i < datetime.length; i++){
        if(!(arrayday.includes(datetime[i].day))){
        arrayday.push(datetime[i].day);
        }
    }

    //ใส่ค่าที่จะส่ง และ submit form
    function addvalue(book_id, people){
        document.getElementById("booking_id").value = book_id;
        document.getElementById("people").value = people;
        document.getElementById("myform").submit()
    }

    //ค้นหาและแสดงผลปุ่มเลยช่องให้ใส่ข้อมูล สำหรับ รับ input ใหม่ๆ
    function change(book_id, date, start_time, people){
        document.getElementById(`changebtn[${book_id}]`).classList.add('hidden');
        document.getElementById(`savebtn[${book_id}]`).classList.remove('hidden');
        document.getElementById(`cancelbtn[${book_id}]`).classList.remove('hidden');
        document.getElementById(`date[${book_id}]`).innerHTML = `<select id="select_date[${book_id}]"><option value="" selected>select day</option></select>`;
        document.getElementById(`time[${book_id}]`).innerHTML = `<select name="time" id="select_time[${book_id}]"></select>`;
        document.getElementById(`table[${book_id}]`).remove();
        document.getElementById(`select_tableshow[${book_id}]`).style.display = 'block';
        var select_date = document.getElementById(`select_date[${book_id}]`);
        var select_time = document.getElementById(`select_time[${book_id}]`);
        
        for (var day of arrayday){
            if (day > date){
                var duration = day
                var option = document.createElement("option");
                option.value = duration
                option.text = duration
                select_date.appendChild(option);
            }
        }

        select_date.addEventListener("change", function() {
            Time(book_id, date, start_time);
            change_table(book_id,people);
        });


        select_time.addEventListener("change", function() {
            change_table(book_id,people);
        });

        document.getElementById(`select_tableshow[${book_id}]`).addEventListener("click" ,function(){
            selected_All = document.querySelector('[data-te-select-option-all-ref]');
            selected_All.remove();
        });

        document.getElementById(`select_table[${book_id}]`).addEventListener("change", function(){
            selected_option(book_id, people)
        })
    }

    //ใส่ตัวเลือกเวลา
    function Time(book_id, date, start_time){
        var selectedDate = document.getElementById(`select_date[${book_id}]`).value;

        var select = document.getElementById(`select_time[${book_id}]`);              
            while (select.firstChild){
                select.removeChild(select.firstChild);
        }

        for(var i = 0; i < datetime.length; i++){
            if(datetime[i].day == selectedDate && datetime[i].day != date){
                var duration = datetime[i].start_time +' - '+ datetime[i].end_time
                var option = document.createElement("option");
                    option.value = datetime[i].id
                    option.text = duration
                    select.appendChild(option);
            }

            if(datetime[i].day == selectedDate && datetime[i].day == date && datetime[i].start_time > start_time){
                var duration = datetime[i].start_time +' - '+ datetime[i].end_time
                var option = document.createElement("option");
                    option.value = datetime[i].id
                    option.text = duration
                    select.appendChild(option);
            }
        }
    }


    var jsontable = [
        {"table": ["A01","A02","A03","A04","A05","A06","A07","A08"], "unit": 2},
        {"table": ["B01","B02","B03","B04","B05","B06","B07","B08","B09","B10","B11","B12"], "unit": 4},
        {"table": ["C01","C02","C03","C04","C05","C06","C07","C08"], "unit": 6}
    ];

    <?php
        date_default_timezone_set("Asia/Bangkok");
        $today = date("Y-m-d");
        $query_table2 = "SELECT time_id,number_table FROM reservations JOIN reserve_table 
        USING (booking_id) JOIN table_time USING (time_id) WHERE day >='{$today}'";
        $result_table2 = mysqli_query($connect, $query_table2);

        if(mysqli_num_rows($result_table2) > 0){
            while($row = mysqli_fetch_assoc($result_table2)){
                $reser_table2[] = array(
                    "time_id" => $row['time_id'],
                    "number_table" => $row['number_table']
                );
            }
        }else{
            $reser_table2[] = array();
        }
    ?>

    
    function change_table(book_id, people){
        var time_id = document.getElementById(`select_time[${book_id}]`).value;
        var select_table = document.getElementById(`select_table[${book_id}]`);
        var reser_table = <?php echo json_encode($reser_table2); ?>;   
        var already_reserved = [];

        for(i = 0 ; i< reser_table.length; i++){
            if(reser_table[i].time_id == time_id){
                already_reserved.push(reser_table[i].number_table)
            }
        }

        while (select_table.firstChild){
            select_table.removeChild(select_table.firstChild);
        }
                                        
        let limit = 0.70;
        var people_num = people
                            
        if(people_num == 1){
            limit = 0.5;
        }

        if(time_id != ""){
            for (var j = 0; j < jsontable.length; j++) {
                var unit = jsontable[j].unit
                for(var k=0; k < jsontable[j].table.length; k++){
                    if(!(already_reserved.includes(jsontable[j].table[k])) && Math.round(people_num*100/unit) >= limit * 100){
                        var duration = jsontable[j].table[k]
                        var option = document.createElement("option");
                        option.value = duration
                        option.text = duration + ' (' + unit + ')'
                        select_table.appendChild(option);
                    }
                }
            }
        }
    }

    function selected_option(book_id,people){
        var select_list = [];
        var notselect_list = [];
        var select_table = document.getElementById(`select_table[${book_id}]`);
            for (const option of select_table.options) {
                if (option.selected) {
                    select_list.push(option.value);
                }
                else{
                    notselect_list.push(option);
                    }
            }

            for (const option of notselect_list){
                option.remove();
            }

        var reser_table = <?php echo json_encode($reser_table2); ?>;
        var time_id = document.getElementById(`select_time[${book_id}]`).value

        var already_reserved = [];
        for(i = 0 ; i< reser_table.length; i++){
            if(reser_table[i].time_id == time_id){
                already_reserved.push(reser_table[i].number_table)
            }
        }

        let limit = 0.70;
        var num_selec = 0
                                        
        for (var namet of jsontable){
            for (var value of select_list){
                if(namet.table.includes(value)){
                    num_selec += namet.unit
                }
            }            
        }

        var people_num = people
        if(people_num - num_selec == 1){
            limit = 0.5;
        }

        for (var j = 0; j < jsontable.length; j++){
            var unit = jsontable[j].unit
            for(var k=0; k < jsontable[j].table.length; k++){
                var number_table = jsontable[j].table[k]
                if(!(already_reserved.includes(number_table)) && Math.round((people_num-num_selec)*100/unit) >= limit * 100 
                    &&!(select_list.includes(number_table))){
                    var duration = number_table
                    var option = document.createElement("option");
                    option.value = duration
                    option.text = duration + ' (' + unit + ')'
                    select_table.appendChild(option);
                }
            }
        }
    }

</script>
<?php mysqli_close($connect);?>
</html>