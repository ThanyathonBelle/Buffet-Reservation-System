<?php include '../connect.php'; session_start();
    //เช็คว่า login หรือยัง
    if (!isset($_SESSION['user_name'])){
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Gabarito:wght@500&family=Kanit:wght@300&family=Merriweather&family=Noto+Sans+Thai:wght@300&family=Playfair+Display:wght@500&family=Poppins:wght@300&family=Roboto+Condensed&family=Roboto:wght@300;400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
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
</head>

<body class="bg-[#49111c]">

    <?php if(isset($_COOKIE["error"])):?>
        <script>
            Swal.fire({
                title: 'Reservation failed',
                text: '<?php echo $_COOKIE["error"];?>',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif ?>

    <!-- nav bar -->
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
                        <a class="text-[#f2f4f3]  transition duration-150 ease-in-out hover:text-[#7a0118] focus:text-[#49111c] lg:px-2"
                            aria-current="page" href="menu.php" data-te-nav-link-ref>Menu</a>
                    </li>
                </ul>

                <div class="flex items-center px-5">
                    <button type="button" data-te-ripple-init data-te-ripple-color="light"
                        class="mr-3 inline-block rounded px-8 pb-2 pt-2.5 text-xs font-medium bg-[#7a0118] uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#49111c] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]">
                        Reservation
                    </button>
                </div>
            </div>
        </div>
    </nav>


    <ul data-te-stepper-init
        class="relative m-0 flex list-none justify-between overflow-hidden p-0 transition-[height] duration-200 ease-in-out">
        <!--First item-->
        <li data-te-stepper-step-ref data-te-stepper-step-active class="w-[4.5rem] flex-auto">
            <div data-te-stepper-head-ref
                class="flex cursor-pointer items-center pl-2 leading-[1.3rem] no-underline after:ml-2 after:h-px after:w-full after:flex-1 after:bg-[#e0e0e0] after:content-[''] hover:bg-[#6b1929] focus:outline-none">
                <span data-te-stepper-head-icon-ref
                    class="my-6 mr-2 flex h-[3rem] w-[3rem] items-center justify-center rounded-full bg-[#0f0e0c] text-sm font-medium text-black">
                    1
                </span>
                <span data-te-stepper-head-text-ref
                    class="text-xl font-medium text-white after:flex after:text-[0.8rem] after:content-[data-content]">
                    Table
                </span>
            </div>
            <div data-te-stepper-content-ref class="absolute w-full p-4 transition-all duration-500 ease-in-out">
                <div class="g-6 flex h-full flex-wrap items-center justify-center lg:justify-between pt-12 pb-36">
                    <!-- Left column container with background-->
                    <div class="mb-12 md:mb-0 md:w-8/12 lg:w-6/12">
                        <img src="../images/buffet table.png" class="w-11/12 mx-auto" alt="Phone image" />
                    </div>

                    <!-- Right column container with form -->
                    <div class="md:w-8/12 lg:ml-6 lg:w-5/12">
                        <h1 class="text-6xl mb-10 justify-center flex text-white">Table</h1>
                        <form action="reservation_db.php" method="post" id="formtime">
                            <!--Date input-->
                            <div class="text-white relative mb-4" id="datepicker-disable-past" data-te-disable-past="true" data-te-datepicker-init data-te-input-wrapper-init data-te-format="yyyy-mm-dd">
                                        <input type="text" name="date" id="date"
                                        class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        placeholder="Select a date" data-te-datepicker-toggle-ref data-te-datepicker-toggle-button-ref/>
                                    <label for="floatingInput"
                                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-white peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">
                                    Select a date</label>
                            </div>

                            <!--Time input-->
                            <div class="text-white relative mb-4">
                                <select name="time" data-te-select-init data-te-select-size="lg" id="time">
                                </select>
                            </div>

                            <!--People input-->
                            <div class="relative mb-4" data-te-input-wrapper-init>
                                <input type="number" name="people" min="1" oninput="this.value = (this.value) ? (this.value < 1) ? 1 : this.value : this.value"
                                    class="text-white peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                    id="people_num" placeholder="people_num"/>
                                <label for="exampleFormControlInput3"
                                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-white peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">People
                                </label>
                            </div>

                            <!--Table input-->
                            <div class="text-white relative mb-4" id="div_table">
                                <select data-te-select-init data-te-select-placeholder="Select Table"
                                    data-te-select-size="lg" multiple id="table" name="table[]">
                                </select>
                            <!--food input-->
                            <input input type="hidden" name="food_db" id="food_inp">
                        </form>
                    </div>
                </div>
            </div>
        </li>

        <!--Second item-->
        <li data-te-stepper-step-ref class="w-[4.5rem] flex-auto">
            <div data-te-stepper-head-ref
                class="flex cursor-pointer items-center leading-[1.3rem] no-underline before:mr-2 before:h-px before:w-full before:flex-1 before:bg-[#e0e0e0] before:content-[''] after:ml-2 after:h-px after:w-full after:flex-1 after:bg-[#e0e0e0] after:content-[''] hover:bg-[#6b1929] focus:outline-none ">
                <span data-te-stepper-head-icon-ref
                    class="my-6 mr-2 flex h-[3rem] w-[3rem] items-center justify-center rounded-full bg-[#ebedef] text-sm font-medium text-[#40464f]">
                    2
                </span>
                <span data-te-stepper-head-text-ref
                    class="text-xl text-white after:flex after:text-[0.8rem] after:content-[data-content]">
                    Order
                </span>
            </div>
            <div data-te-stepper-content-ref
                class="absolute left-0 w-full translate-x-[150%] p-4 transition-all duration-500 ease-in-out">
                <div class=" flex h-full flex-wrap items-center justify-center lg:justify-between py-20">
                    <!-- Left column container with background-->
                    <div class="mx-auto mb-12 md:mb-0 sm:w-full md:w-8/12 lg:w-2/5">
                        <img src="../images/27.JPG" alt="Table Full of Spices" class="w-full" />
                    </div>

                    <!-- Right column container with form -->
                    <div class="md:w-8/12 lg:ml-6 lg:w-5/12">
                        <h1 class="text-6xl mb-10 justify-center flex  text-white">Order</h1>
                        <!-- Pills navs -->
                        <ul class="mb-12 flex list-none flex-col flex-wrap pl-0 md:flex-row" role="tablist"
                            data-te-nav-ref>
                            <li role="speciallity" class="flex-grow basis-0 text-center">
                                <a href="#pills-speciallity"
                                    class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-primary-100 data-[te-nav-active]:text-primary-700 md:mr-4"
                                    id="pills-speciallity-tab" data-te-toggle="pill" data-te-target="#pills-speciallity"
                                    data-te-nav-active role="tab" aria-controls="pills-speciallity"
                                    aria-selected="true">Speciallity</a>
                            </li>
                            <li role="appetizers" class="flex-grow basis-0 text-center">
                                <a href="#pills-appetizers"
                                    class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-primary-100 data-[te-nav-active]:text-primary-700 md:mr-4"
                                    id="pills-appetizers-tab" data-te-toggle="pill" data-te-target="#pills-appetizers"
                                    role="tab" aria-controls="pills-appetizers" aria-selected="false">Appetizers</a>
                            </li>
                            <li role="salads" class="flex-grow basis-0 text-center">
                                <a href="#pills-salads"
                                    class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-primary-100 data-[te-nav-active]:text-primary-700 md:mr-4"
                                    id="pills-salads-tab" data-te-toggle="pill" data-te-target="#pills-salads"
                                    role="tab" aria-controls="pills-salads" aria-selected="false">Salads</a>
                            </li>
                            <li role="maincourses" class="flex-grow basis-0 text-center">
                                <a href="#pills-maincourses"
                                    class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-primary-100 data-[te-nav-active]:text-primary-700 md:mr-4"
                                    id="pills-maincourses-tab" data-te-toggle="pill" data-te-target="#pills-maincourses"
                                    role="tab" aria-controls="pills-maincourses" aria-selected="false">MainCourses</a>
                            </li>
                            <li role="sides" class="flex-grow basis-0 text-center">
                                <a href="#pills-sides"
                                    class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-primary-100 data-[te-nav-active]:text-primary-700 md:mr-4"
                                    id="pills-sides-tab" data-te-toggle="pill" data-te-target="#pills-sides" role="tab"
                                    aria-controls="pills-sides" aria-selected="false">Sides</a>
                            </li>
                            <li role="desserts" class="flex-grow basis-0 text-center">
                                <a href="#pills-desserts"
                                    class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-primary-100 data-[te-nav-active]:text-primary-700 md:mr-4"
                                    id="pills-desserts-tab" data-te-toggle="pill" data-te-target="#pills-desserts"
                                    role="tab" aria-controls="pills-desserts" aria-selected="false">Desserts</a>
                            </li>
                            <li role="beverages" class="flex-grow basis-0 text-center">
                                <a href="#pills-beverages"
                                    class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-primary-100 data-[te-nav-active]:text-primary-700 md:mr-4"
                                    id="pills-beverages-tab" data-te-toggle="pill" data-te-target="#pills-beverages"
                                    role="tab" aria-controls="pills-beverages" aria-selected="false">Beverages</a>
                            </li>
                        </ul>
                        <!--Pills content-->
                        <div class="mb-6 text-white">
                            <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                                id="pills-speciallity" role="tabpanel" aria-labelledby="pills-speciallity-tab"
                                data-te-tab-active>
                                <div class="relative h-[250px] overflow-hidden" data-te-perfect-scrollbar-init>
                                <!--Speciallity input-->
                                    <div>
                                        <?php 
                                            $query_menu = "SELECT food_id,food_name FROM menu WHERE category = 'Speciality'";
                                            $result_menu = mysqli_query($connect, $query_menu);
                                        ?>
                                        <?php while ($row = mysqli_fetch_assoc($result_menu)):?>
                                            <div class="flex justify-between mb-4 mx-4">
                                                <div class="text-xl"><?php echo $row['food_name']?></div>
                                                <select data-te-select-init data-te-select-size="lg" name="food[<?php echo $row['food_id']?>][quantity]">
                                                    <option value="0" selected>0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        <?php endwhile;?>
                                    </div>
                                </div>
                            </div>

                            <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                                id="pills-appetizers" role="tabpanel" aria-labelledby="pills-appetizers-tab">
                                <div class="relative h-[250px] overflow-hidden" data-te-perfect-scrollbar-init>
                                <!--Appetizers input-->
                                    <div>
                                        <?php
                                            $query_menu = "SELECT food_id,food_name FROM menu WHERE category = 'Appetizers'";
                                            $result_menu = mysqli_query($connect, $query_menu);
                                        ?>
                                        <?php while($row = mysqli_fetch_assoc($result_menu)):?>
                                            <div class="flex justify-between mb-4 mx-4">
                                                <div class="text-xl"><?php echo $row['food_name']?></div>
                                                    <select data-te-select-init data-te-select-size="lg" name="food[<?php echo $row['food_id']?>][quantity]">
                                                        <option value="0" selected>0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                            </div>
                                        <?php endwhile;?>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                                id="pills-salads" role="tabpanel" aria-labelledby="pills-salads-tab">
                                <div class="relative h-[250px] overflow-hidden" data-te-perfect-scrollbar-init>
                                <!--Salads input-->
                                    <div>
                                        <?php
                                            $query_menu = "SELECT food_id,food_name FROM menu WHERE category = 'Salads'";
                                            $result_menu = mysqli_query($connect, $query_menu);
                                        ?>
                                        <?php while ($row = mysqli_fetch_assoc($result_menu)):?>
                                            <div class="flex justify-between mb-4 mx-4">
                                                <div class="text-xl"><?php echo $row['food_name']?></div>
                                                    <select data-te-select-init data-te-select-size="lg" name="food[<?php echo $row['food_id']?>][quantity]">
                                                        <option value="0" selected>0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                   </select>
                                            </div>
                                        <?php endwhile ?>
                                    </div>
                                </div>   
                            </div>
                            <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                                id="pills-maincourses" role="tabpanel" aria-labelledby="pills-maincourses-tab">
                                <div class="relative h-[250px] overflow-hidden" data-te-perfect-scrollbar-init>
                                <!--Main Courses input-->
                                    <div>
                                        <?php 
                                            $query_menu = "SELECT food_id,food_name FROM menu WHERE category = 'Main Courses'";
                                            $result_menu = mysqli_query($connect, $query_menu);
                                        ?>
                                        <?php while ($row = mysqli_fetch_assoc($result_menu)):?>
                                            <div class="flex justify-between mb-4 mx-4">
                                                <div class="text-xl"><?php echo $row['food_name']?></div>
                                                <select data-te-select-init data-te-select-size="lg" name="food[<?php echo $row['food_id']?>][quantity]">
                                                    <option value="0" selected>0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                           </div>
                                        <?php endwhile ?>
                                    </div>
                                </div>   
                            </div>
                            <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                                id="pills-sides" role="tabpanel" aria-labelledby="pills-sides-tab">
                                <div class="relative h-[250px] overflow-hidden" data-te-perfect-scrollbar-init>
                                <!--Sides input-->
                                    <div>
                                        <?php 
                                            $query_menu = "SELECT food_id,food_name FROM menu WHERE category = 'Sides'";
                                            $result_menu = mysqli_query($connect, $query_menu);?>
                                        <?php while ($row = mysqli_fetch_assoc($result_menu)):?>
                                            <div class="flex justify-between mb-4 mx-4">
                                                <div class="text-xl"><?php echo $row['food_name']?></div>
                                                <select data-te-select-init data-te-select-size="lg" name="food[<?php echo $row['food_id']?>][quantity]">
                                                    <option value="0" selected>0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        <?php endwhile ?>
                                    </div>
                                </div>  
                            </div>
                            <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                                id="pills-desserts" role="tabpanel" aria-labelledby="pills-desserts-tab">
                                <div class="relative h-[250px] overflow-hidden" data-te-perfect-scrollbar-init>
                                    <!--Desserts input-->
                                        <div>
                                        <?php
                                            $query_menu = "SELECT food_id,food_name FROM menu WHERE category = 'Desserts'";
                                            $result_menu = mysqli_query($connect, $query_menu)?>
                                        <?php while ($row = mysqli_fetch_assoc($result_menu)):?>
                                            <div class="flex justify-between mb-4 mx-4">
                                                <div class="text-xl"><?php echo $row['food_name']?></div>
                                                <select data-te-select-init data-te-select-size="lg" name="food[<?php echo $row['food_id']?>][quantity]">
                                                    <option value="0" selected>0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        <?php endwhile ?>
                                    </div>
                                </div>  
                            </div>
                            <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                                id="pills-beverages" role="tabpanel" aria-labelledby="pills-beverages-tab">
                                <div class="relative h-[250px] overflow-hidden" data-te-perfect-scrollbar-init>
                                    <!--Beverages input-->
                                    <div>
                                        <?php 
                                            $query_menu = "SELECT food_id, food_name FROM menu WHERE category = 'Beverages'";
                                            $result_menu = mysqli_query($connect, $query_menu)?>
                                        <?php while ($row = mysqli_fetch_assoc($result_menu)):?>
                                            <div class="flex justify-between mb-4 mx-4">
                                                <div class="text-xl"><?php echo $row['food_name']?></div>
                                                <select data-te-select-init data-te-select-size="lg" name="food[<?php echo $row['food_id']?>][quantity]">
                                                    <option value="0" selected>0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                </div>
                                        <?php endwhile ?>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>

        <!--Third item-->
        <li data-te-stepper-step-ref class="w-[4.5rem] flex-auto">
            <div data-te-stepper-head-ref id="payment"
                class="flex cursor-pointer items-center pr-2 leading-[1.3rem] no-underline before:mr-2 before:h-px before:w-full before:flex-1 before:bg-[#e0e0e0] before:content-[''] hover:bg-[#6b1929] focus:outline-none ">
                <span data-te-stepper-head-icon-ref
                    class="my-6 mr-2 flex h-[3rem] w-[3rem] items-center justify-center rounded-full bg-[#ebedef] text-sm font-medium text-[#40464f]">
                    3
                </span>
                <span data-te-stepper-head-text-ref
                    class="text-xl text-white after:flex after:text-[0.8rem] after:content-[data-content]">
                    Pay
                </span>
            </div>
            <div data-te-stepper-content-ref
                class="absolute left-0 w-full translate-x-[150%] p-4 transition-all duration-500 ease-in-out">
                <div class="g-6 flex h-full flex-wrap justify-center lg:justify-between py-10 lg:py-20">
                    <!-- Left column container with background-->
                    <div class="text-white md:w-8/12 lg:ml-6 lg:w-5/12">
                        <h1 class="text-6xl mb-10 justify-center flex text-white">Payment</h1>
                        <form>
                            <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
                                <input
                                    class="relative float-left -ml-[1.5rem] mr-1 mt-0.5 h-5 w-5 appearance-none rounded-full border-2 border-solid border-neutral-300 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]"
                                    type="radio" name="flexRadioDefault" id="radioDefault01" checked />
                                <label class="text-xl mt-px inline-block pl-[0.15rem] hover:cursor-pointer"
                                    for="radioDefault01">
                                    <img src="https://companieslogo.com/img/orig/PYPL-3570673e.png?t=1633695449" class="w-[30px] inline mr-3"><span class="font-light">PayPal</span>
                                </label>
                            </div>
                            <hr class="my-5 h-0.5 border-t-0 bg-neutral-100 opacity-100" />
                            <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
                                <input
                                    class="relative float-left -ml-[1.5rem] mr-1 mt-0.5 h-5 w-5 appearance-none rounded-full border-2 border-solid border-neutral-300 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]"
                                    type="radio" name="flexRadioDefault" id="radioDefault03"/>
                                <label class="text-xl mt-px inline-block pl-[0.15rem] hover:cursor-pointer"
                                    for="radioDefault03">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/MasterCard_Logo.svg/2560px-MasterCard_Logo.svg.png" class="w-[40px] inline mr-3"><span class="font-light">Master Card</span>
                                </label>
                            </div>
                            <hr class="my-5 h-0.5 border-t-0 bg-neutral-100 opacity-100" />
                            <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem] pb-5">
                                <input
                                    class="relative float-left -ml-[1.5rem] mr-1 mt-0.5 h-5 w-5 appearance-none rounded-full border-2 border-solid border-neutral-300 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]"
                                    type="radio" name="flexRadioDefault" id="radioDefault02" />
                                <label class="text-xl mt-px inline-block pl-[0.15rem] hover:cursor-pointer"
                                    for="radioDefault02">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Visa_Logo.png/640px-Visa_Logo.png" class="w-[40px] inline mr-3"><span class="font-light">Visa</span>
                                </label>
                            </div>

                            <!--Card number input-->
                            <div class="text-xl mb-2">Card number</div>
                            <div class="relative mb-4" data-te-input-wrapper-init>
                                <input type="card"
                                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                    id="exampleFormControlInput3" placeholder="0000 0000 0000 0000" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-xl mb-2">Expiry Date</div>
                                    <div class="relative mb-6" data-te-input-wrapper-init>
                                        <input type="card"
                                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                            id="exampleFormControlInput3" placeholder="MM/YY" />
                                    </div>
                                </div>

                                <div>
                                    <div class="text-xl mb-2">CVC/CVV</div>
                                    <div class="relative mb-6" data-te-input-wrapper-init>
                                        <input type="card"
                                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                            id="exampleFormControlInput3" placeholder="---" />
                                    </div>
                                </div>
                            </div>
                    </div>

                    <?php
                        $username = $_SESSION['user_name'];
                        $query_member = "SELECT first_name,last_name FROM member WHERE user_name = '$username'";
                        $result_member = mysqli_query($connect, $query_member);
                    ?>

                    <!-- Right column container with form -->
                    <div class="text-white pt-12 mb-12 md:mb-0 md:w-8/12 lg:w-6/12 lg:pt-0">
                        <h1 class="text-6xl mb-10 justify-center flex text-white">Summary</h1>
                        <div class="text-xl mb-4">
                        <?php
                            while ($row = mysqli_fetch_array($result_member)){
                                echo $row['first_name'].' '.$row['last_name'];
                            }
                        ?></div>

                        <div class="relative overflow-hidden h-52" data-te-perfect-scrollbar-init id='summary'>
                            <div class="flex justify-between">
                                <div class="text-xl mb-2">Date</div>
                                <div class="text-xl mb-2" id = "showdate"></div>
                            </div>
                                <div class="flex justify-between">
                                    <div class="text-xl mb-2">Time</div>
                                    <div class="text-xl mb-2" id = "showtime"></div>
                                </div>
                            <div class="flex justify-between">
                                <div class="text-xl mb-2">People</div>
                                <div class="text-xl mb-2" id = "showpeople"></div>
                            </div>
                            <div class="flex justify-between">
                                <div class="text-xl mb-2">Table</div>
                                <div class="text-xl mb-2" id = "showtable"></div>
                            </div>
                        </div>
                        <hr class="my-5 h-0.5 border-t-0 bg-neutral-100 opacity-100" />
                        <div class="flex justify-between">
                            <div class="text-xl mb-2">Total Price</div>
                            <div class="text-xl mb-2" id = "showprice"></div>
                        </div>
                        <div class="pt-6 flex justify-center">
                            <button type="button" id="submit-form" name="submit-form"
                                class="inline-block rounded bg-primary px-20 pb-2 pt-2.5 text-base font-medium bg-black uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#7a0118] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]"
                                data-te-ripple-init data-te-ripple-color="light" data-te-toggle="popconfirm"
                                data-te-popconfirm-mode="modal">
                                Purchase
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</body>


<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>


<?php
//ดึงข้อมูลเวลาจาก database 
    date_default_timezone_set("Asia/Bangkok");
    $today = date("Y-m-d");
    $timeday = date("H:i:s");
    $query_time = "SELECT * FROM table_time WHERE day > '{$today}'";
    $result_time = mysqli_query($connect, $query_time);

    $query_time2 = "SELECT * FROM table_time WHERE day = '{$today}' and start_time > '{$timeday}'";
    $result_time2 = mysqli_query($connect, $query_time2);

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

    if(mysqli_num_rows($result_time2) > 0){
        while($row = mysqli_fetch_assoc($result_time2)){
            $datetime[] = array(
                "id" => $row['time_id'],    
                "day" => $row['day'],
                "start_time" => $row['start_time'],
                "end_time" => $row['end_time']
            );
        }
    }
?>

<script>
    //นำข้อมูลจาก database เปลี่ยน json สร้างตัวแปร javascript ข้อมูลจาก php
    var datetime = <?php echo json_encode($datetime); ?>;
    document.getElementById("date").addEventListener("click", Time)
    //แสดงเพิ่ม option เวลา ของวันที่นั้น โดยดึงข้อมูล database
    function Time(){
        document.querySelector('[aria-label="Confirm selection"]').addEventListener("click", function() {
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
            document.getElementById("people_num").value = ""
        })

        document.querySelector('[aria-label="Clear selection"]').addEventListener("click", function() {
            var select = document.getElementById("time");
            while (select.firstChild){
                select.removeChild(select.firstChild);
            }
        })
    }

    <?php
        //โดยดึงข้อมูลโต๊ะที่ถูกจองจากเวลาปัจจุบัน database
        $query_table = "SELECT time_id,number_table FROM reservations JOIN reserve_table 
        USING (booking_id) JOIN table_time USING (time_id) WHERE day >='{$today}'";
        $result_table = mysqli_query($connect, $query_table);

        if(mysqli_num_rows($result_table) > 0){
            while($row = mysqli_fetch_assoc($result_table)){
            $reser_table[] = array(
                "time_id" => $row['time_id'],
                "number_table" => $row['number_table']
            );
        }
        }else{
            $reser_table[] = array();
        }
    ?>


    var jsontable = [
        {"table": ["A01","A02","A03","A04","A05","A06","A07","A08"], "unit": 2},
        {"table": ["B01","B02","B03","B04","B05","B06","B07","B08","B09","B10","B11","B12"], "unit": 4},
        {"table": ["C01","C02","C03","C04","C05","C06","C07","C08"], "unit": 6}
    ];

    var reser_table = <?php echo json_encode($reser_table); ?>;
    var select_table = document.getElementById("table");

    //สำหรับเพิ่มตัวเลือกของโต๊ะที่สามารถจองได้ สำหรับเปลี่ยนเวลากับเปลี่ยนจำนวนคน คำนวนโต๊ะเหมาะสมกับจำนวนคน
    function change_table(){
        var time_id = document.getElementById("time").value;
        var already_reserved = [];

        for(i = 0 ; i< reser_table.length; i++){
            if(reser_table[i].time_id == time_id){
                already_reserved.push(reser_table[i].number_table)
            }
        }

        while (select_table.firstChild){
            select_table.removeChild(select_table.firstChild);
        }
                                        
        let limit = 70;
        var people_num = document.getElementById("people_num").value
                            
        if(people_num == 1){
            limit = 50;
        }
        if(time_id != ""){
            for (var j = 0; j < jsontable.length; j++) {
                var unit = jsontable[j].unit
                for(var k=0; k < jsontable[j].table.length; k++){
                    if(!(already_reserved.includes(jsontable[j].table[k])) && Math.round(people_num*100/unit) >= limit){
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

    document.getElementById("people_num").addEventListener("change", change_table)
    document.getElementById("time").addEventListener("change", change_table)
                                    
    select_table.addEventListener("change", selected_option);

    document.getElementById("div_table").addEventListener("click" ,function(){
        selected_All = document.querySelector('[data-te-select-option-all-ref]');
        selected_All.remove();
    });

    //สำหรับเพิ่มตัวเลือก และเลือกตัวเลือกที่ถูกเลือกไว้ คำนวนโต๊ะเหมาะสมกับจำนวนคน
    function selected_option(){
        var select_list = [];
        var notselect_list = [];
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

        var reser_table = <?php echo json_encode($reser_table); ?>;
        var time_id = document.getElementById("time").value;

        var already_reserved = [];
            for(i = 0 ; i< reser_table.length; i++){
                if(reser_table[i].time_id == time_id){
                    already_reserved.push(reser_table[i].number_table)
                }
            }

        let limit = 70;
        var num_selec = 0
                                        
        for (var namet of jsontable){
            for (var value of select_list){
                if(namet.table.includes(value)){
                    num_selec += namet.unit
                }
            }            
        }

        var people_num = document.getElementById("people_num").value
            if(people_num - num_selec == 1){
                limit = 50;
        }

        for (var j = 0; j < jsontable.length; j++){
            var unit = jsontable[j].unit
            for(var k=0; k < jsontable[j].table.length; k++){
                var number_table = jsontable[j].table[k]
                if(!(already_reserved.includes(number_table)) && Math.round((people_num-num_selec)*100/unit) >= limit 
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

    <?php
        $query_menu = "SELECT food_id, food_name FROM menu";
        $result_menu = mysqli_query($connect, $query_menu);
        if(mysqli_num_rows($result_menu) > 0){
            while($row = mysqli_fetch_assoc($result_menu)){
                $menu_array[] = array(
                    "food_id" => $row['food_id'],
                    "name" => $row['food_name']
                );
            }
        }else{
            $menu_array[] = array();
        }
        $menu_array = json_encode($menu_array);
    ?>

    //แสดงผลหน้าชำระเงิน
    document.getElementById("payment").addEventListener("click",function(){
        var select_time = document.getElementById("time")

        for(option of select_time.options){
            if(option.selected){
                var time = option.text
            }
        }

        var select_table = document.getElementById("table");
        var table_txt = ''

        for (const option of select_table.options) {
            if (option.selected) {
                table_txt += option.value + " "
            }
        }

        document.getElementById("showdate").innerHTML = document.getElementById("date").value;
        document.getElementById("showtime").innerHTML = time;
        document.getElementById("showpeople").innerHTML = document.getElementById("people_num").value;
        document.getElementById("showtable").innerHTML = table_txt;
        document.getElementById("showprice").innerHTML = document.getElementById("people_num").value * 1390;

        var menu_array = <?php echo $menu_array; ?>;
        var showfood = document.querySelectorAll('#Showfood');

        if(showfood){
            showfood.forEach(element => {
                    element.remove();
            });
        }

        var foodarray = []
        for (var menu of menu_array){
            var food_id = menu.food_id
            inp_quantity = document.getElementsByName(`food[${food_id}][quantity]`)[0].value
            if(inp_quantity > 0){
                var div1 = document.createElement('div');
                var div_name = document.createElement('div');
                var div_num = document.createElement('div');
                div1.classList.add('flex', 'justify-between');
                div1.setAttribute('id','Showfood')
                div_name.classList.add('text-xl','mb-2');
                div_num.classList.add('text-xl','mb-2');
                div_name.textContent = menu.name;
                div_num.textContent = inp_quantity;
                div1.appendChild(div_name);
                div1.appendChild(div_num);
                document.getElementById('summary').appendChild(div1);
                var newFood = {"name": food_id, "quantity": inp_quantity };
                foodarray.push(newFood)
            }
        }
        document.getElementById('food_inp').value = JSON.stringify(foodarray)
    })

    document.getElementById("submit-form").addEventListener("click",function(){
        document.getElementById('popconfirm-button-confirm').addEventListener("click",function(){
            document.getElementById('formtime').submit()
        })
    })
</script>
<?php mysqli_close($connect);?>
</html>