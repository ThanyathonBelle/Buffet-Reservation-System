<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Gabarito:wght@500&family=Kanit:wght@300&family=Merriweather&family=Noto+Sans+Thai:wght@300&family=Playfair+Display:wght@500&family=Poppins:wght@300&family=Roboto+Condensed&family=Roboto:wght@300;400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
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

<body class="bg-[#49111c]">
    <?php
    include '../connect.php';
    $app = true;
    $salad = true;
    $main = true;
    $side = true;
    $dessert = true;
    $bev = true;
    ?>
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
                        <a class="text-[#f2f4f3]  transition duration-150 ease-in-out hover:text-[#7a0118] focus:text-[#570111] lg:px-2"
                            aria-current="page" href="#Speciality" data-te-nav-link-ref
                            data-te-smooth-scroll-init>Speciality</a>
                    </li>

                    <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                        <a class="text-[#f2f4f3]  transition duration-150 ease-in-out hover:text-[#7a0118] focus:text-[#570111] lg:px-2"
                            aria-current="page" href="#Appetizers" data-te-nav-link-ref
                            data-te-smooth-scroll-init>Appetizers</a>
                    </li>

                    <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                        <a class="text-[#f2f4f3]  transition duration-150 ease-in-out hover:text-[#7a0118] focus:text-[#570111] lg:px-2"
                            aria-current="page" href="#Salads" data-te-nav-link-ref
                            data-te-smooth-scroll-init>Salads</a>
                    </li>

                    <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                        <a class="text-[#f2f4f3]  transition duration-150 ease-in-out hover:text-[#7a0118] focus:text-[#570111] lg:px-2"
                            aria-current="page" href="#Main" data-te-nav-link-ref data-te-smooth-scroll-init>Main
                            Courses</a>
                    </li>

                    <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                        <a class="text-[#f2f4f3]  transition duration-150 ease-in-out hover:text-[#7a0118] focus:text-[#570111] lg:px-2"
                            aria-current="page" href="#Sides" data-te-nav-link-ref data-te-smooth-scroll-init>Sides</a>
                    </li>

                    <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                        <a class="text-[#f2f4f3]  transition duration-150 ease-in-out hover:text-[#7a0118] focus:text-[#570111] lg:px-2"
                            aria-current="page" href="#Desserts" data-te-nav-link-ref
                            data-te-smooth-scroll-init>Desserts</a>
                    </li>

                    <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                        <a class="text-[#f2f4f3]  transition duration-150 ease-in-out hover:text-[#7a0118] focus:text-[#570111] lg:px-2"
                            aria-current="page" href="#Beverages" data-te-nav-link-ref
                            data-te-smooth-scroll-init>Beverages</a>
                    </li>
                </ul>

                <div class="flex items-center px-5">
                    <a href="reservation.php" >
                    <button type="button" data-te-ripple-init data-te-ripple-color="light"
                        class="mr-3 inline-block rounded bg-[#7a0118] px-8 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]">
                        Reservation
                    </button>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!--Menu section -->
    <section class="pb-12">
        <div class="text-6xl pt-14 flex justify-center text-white">Menu</div>

        <!--Speciallity-->
        <?php $query_special = "SELECT * FROM menu WHERE category = 'Speciality'"; ?>
        <?php $result_menu = mysqli_query($connect, $query_special) ?>
        <div id="Speciality" class="pt-16 w-5/6 mx-auto px-6 ">
            <div
                class="text-white text-4xl flex justify-center items-center py-10 before:mr-2 before:h-px before:w-full before:flex-1 before:bg-[#e0e0e0] before:content-[''] after:ml-2 after:h-px after:w-full after:flex-1 after:bg-[#e0e0e0] after:content-['']">
                Speciality<span><img src="../images/pumpkin.png" class="ml-2 w-[60px] inline-block"></span></div>
            <div class="justify-center grid gap-4 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 justify-items-center ">
                <?php while ($row = mysqli_fetch_assoc($result_menu)): ?>
                    <div
                        class="w-64 mx-3 mt-6 flex flex-col self-start rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] sm:shrink-0 sm:grow sm:basis-0 transition duration-300 ease-in-out hover:scale-110">
                        <button data-te-toggle="modal" data-te-target="#menu<?php echo $row['food_id'] ?>"
                            data-te-ripple-init data-te-ripple-color="light">
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']) ?>"
                                class="rounded-t-lg">
                        </button>
                        <div class="p-6">
                            <h5
                                class="mb-2 text-base font-medium leading-tight text-neutral-800 text-center">
                                <?php echo $row['food_name'] ?>
                            </h5>
                        </div>
                    </div>

                    <div data-te-modal-init
                        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                        id="menu<?php echo $row['food_id'] ?>" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
                        aria-modal="true" role="dialog">
                        <div data-te-modal-dialog-ref
                            class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px] min-[1200px]:max-w-[1140px]">
                            <div
                                class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none">
                                <!--Modal body-->
                                <div class="flex flex-col md:flex-row">
                                    <div>
                                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']) ?>"
                                            class="rounded-t-lg">
                                    </div>

                                    <div class="flex flex-col justify-start p-6">
                                        <h5 class="mb-2 text-5xl font-medium text-neutral-800">
                                            <?php echo $row['food_name'] ?>
                                        </h5>
                                        <p class="mb-4 text-base text-neutral-600">
                                            <?php echo $row['details'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div
        class="mt-auto flex flex-shrink-0 sm:hidden flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 min-[0px]:rounded-none">
        <button
          type="button"
          class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
          data-te-modal-dismiss>
          Close
        </button>
      </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            </div>
        </div>

        <!--Menus-->
        <?php $query_menu = "SELECT * FROM menu WHERE category != 'Speciality' 
        ORDER BY CASE 
                WHEN category = 'Appetizers' THEN 1
                WHEN category = 'Salads' THEN 2
                WHEN category = 'Main Courses' THEN 3
	            WHEN category = 'Sides' THEN 4
	            WHEN category = 'Desserts' THEN 5
	            WHEN category = 'Beverages' THEN 6
                END,food_id "; ?>
        <?php $result_menu = mysqli_query($connect, $query_menu) ?>
        <?php while ($row = mysqli_fetch_assoc($result_menu)): ?>
            <?php if ($row['category'] == "Appetizers" & $app) {
                echo '<div id="Appetizers" class="pt-16 w-5/6 mx-auto px-6 " data-te-animation-init data-te-animation-start="onScroll"
                data-te-animation-reset="true" data-te-animation="[fade-in_1s_ease-in-out]">
                <div
                    class="text-white text-4xl flex justify-center items-center py-10 before:mr-2 before:h-px before:w-full before:flex-1 before:bg-[#e0e0e0] ' . "before:content-[''] after:ml-2 after:h-px after:w-full after:flex-1 after:bg-[#e0e0e0] after:content-['']" . '">
                    Appetizers</div> <div class="justify-center grid gap-4 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 justify-items-center ">';
                $app = false;
            } else if ($row['category'] == "Salads" & $salad) {
                echo '</div></div><div id="Salads" class="pt-16 w-5/6 mx-auto px-6 " data-te-animation-init data-te-animation-start="onScroll"
                data-te-animation-reset="true" data-te-animation="[fade-in_1s_ease-in-out]">
                <div
                    class="text-white text-4xl flex justify-center items-center py-10 before:mr-2 before:h-px before:w-full before:flex-1 before:bg-[#e0e0e0] ' . "before:content-[''] after:ml-2 after:h-px after:w-full after:flex-1 after:bg-[#e0e0e0] after:content-['']" . '">
                    Salads</div> <div class="justify-center grid gap-4 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 justify-items-center ">';
                $salad = false;
            } else if ($row['category'] == "Main Courses" & $main) {
                echo '</div></div><div id="Main" class="pt-16 w-5/6 mx-auto px-6 " data-te-animation-init data-te-animation-start="onScroll"
                data-te-animation-reset="true" data-te-animation="[fade-in_1s_ease-in-out]">
                <div
                    class="text-white text-4xl flex justify-center items-center py-10 before:mr-2 before:h-px before:w-full before:flex-1 before:bg-[#e0e0e0] ' . "before:content-[''] after:ml-2 after:h-px after:w-full after:flex-1 after:bg-[#e0e0e0] after:content-['']" . '">
                    Main Courses</div> <div class="justify-center grid gap-4 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 justify-items-center ">';
                $main = false;
            } else if ($row['category'] == "Sides" & $side) {
                echo '</div></div><div id="Sides" class="pt-16 w-5/6 mx-auto px-6 " data-te-animation-init data-te-animation-start="onScroll"
                data-te-animation-reset="true" data-te-animation="[fade-in_1s_ease-in-out]">
                <div
                    class="text-white text-4xl flex justify-center items-center py-10 before:mr-2 before:h-px before:w-full before:flex-1 before:bg-[#e0e0e0] ' . "before:content-[''] after:ml-2 after:h-px after:w-full after:flex-1 after:bg-[#e0e0e0] after:content-['']" . '">
                    Sides</div> <div class="justify-center grid gap-4 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 justify-items-center ">';
                $side = false;
            } else if ($row['category'] == "Desserts" & $dessert) {
                echo '</div></div><div id="Desserts" class="pt-16 w-5/6 mx-auto px-6 " data-te-animation-init data-te-animation-start="onScroll"
                data-te-animation-reset="true" data-te-animation="[fade-in_1s_ease-in-out]">
                <div
                    class="text-white text-4xl flex justify-center items-center py-10 before:mr-2 before:h-px before:w-full before:flex-1 before:bg-[#e0e0e0] ' . "before:content-[''] after:ml-2 after:h-px after:w-full after:flex-1 after:bg-[#e0e0e0] after:content-['']" . '">
                    Desserts</div> <div class="justify-center grid gap-4 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 justify-items-center ">';
                $dessert = false;
            } else if ($row['category'] == "Beverages" & $bev) {
                echo '</div></div><div id="Beverages" class="pt-16 w-5/6 mx-auto px-6 " data-te-animation-init data-te-animation-start="onScroll"
                data-te-animation-reset="true" data-te-animation="[fade-in_1s_ease-in-out]">
                <div
                    class="text-white text-4xl flex justify-center items-center py-10 before:mr-2 before:h-px before:w-full before:flex-1 before:bg-[#e0e0e0] ' . "before:content-[''] after:ml-2 after:h-px after:w-full after:flex-1 after:bg-[#e0e0e0] after:content-['']" . '">
                    Beverages</div> <div class="justify-center grid gap-4 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 justify-items-center ">';
                $bev = false;
            } ?>

            <div
                class="w-64 mx-3 mt-6 flex flex-col self-start rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] sm:shrink-0 sm:grow sm:basis-0 transition duration-300 ease-in-out hover:scale-110">
                <button data-te-toggle="modal" data-te-target="#menu<?php echo $row['food_id'] ?>" data-te-ripple-init
                    data-te-ripple-color="light">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']) ?>"
                        class="rounded-t-lg">
                </button>
                <div class="p-6">
                    <h5 class="mb-2 text-base font-medium leading-tight text-neutral-800 text-center">
                        <?php echo $row['food_name'] ?>
                    </h5>
                </div>
            </div>


            <div data-te-modal-init
                class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                id="menu<?php echo $row['food_id'] ?>" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
                aria-modal="true" role="dialog">
                <div data-te-modal-dialog-ref
                    class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px] min-[1200px]:max-w-[1140px]">
                    <div
                        class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none ">
                        <!--Modal body-->
                        <div class="flex flex-col md:flex-row">
                            <div>
                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']) ?>"
                                    class="rounded-t-lg">
                            </div>

                            <div class="flex flex-col justify-start p-6">
                                <h5 class="mb-2 text-5xl font-medium text-neutral-800">
                                    <?php echo $row['food_name'] ?>
                                </h5>
                                <p class="mb-4 text-base text-neutral-600">
                                    <?php echo $row['details'] ?>
                                </p>
                            </div>
                        </div>
                        <div
        class="mt-auto flex flex-shrink-0 sm:hidden flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 min-[0px]:rounded-none">
        <button
          type="button"
          class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
          data-te-modal-dismiss>
          Close
        </button>
      </div>
                    </div>
                </div>
            </div>

        <?php endwhile ?>
        <?php mysqli_close($connect); ?>
        </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>

</html>