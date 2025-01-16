<?php include 'connect.php';
  session_start();

  if(isset($_GET['logout'])){
    session_destroy();
    header('location: index.php');
  }

  if(isset($_SESSION['role'])){
    session_destroy();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Gabarito:wght@500&family=Kanit:wght@300&family=Merriweather&family=Noto+Sans+Thai:wght@300&family=Playfair+Display:wght@500&family=Poppins:wght@300&family=Roboto+Condensed&family=Roboto:wght@300;400&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
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

  <?php if(isset($_COOKIE["login"])):?>
    <script>
      Swal.fire({
        title: 'Welcome RUBY BUFFET',
        text: '<?php echo $_COOKIE["login"];?>',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    </script>
  <?php endif ?>

  <?php if(isset($_COOKIE["reg"])):?>
    <script>
      Swal.fire({
        title: 'Welcome RUBY BUFFET',
        text: '<?php echo $_COOKIE["reg"];?>',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    </script>
    <?php endif ?>
  <!-- Main navigation container -->
  <nav
    class="sticky top-0 z-10 w-full flex-wrap items-center justify-between bg-[#0f0e0c] py-2 text-neutral-500 shadow-lg hover:text-neutral-700 focus:text-neutral-700 lg:py-4"
    data-te-navbar-ref>
    <div class="flex w-full flex-wrap items-center justify-between px-3">
      <div>
        <a class="mx-2 my-1 flex font-bold items-center text-white lg:mb-0 lg:mt-0" href="index.php">
          <img class="w-[70px]" src="images/logo.png" alt="Logo" loading="lazy" /><span>RUBY BUFFET</span>
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
              aria-current="page" href="customer/menu.php" data-te-nav-link-ref>Menu</a>
          </li>

        <?php if(!isset($_SESSION['user_name'])):?>
          <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
            <a class="text-[#f2f4f3]  transition duration-150 ease-in-out hover:text-[#7a0118] focus:text-[#570111] lg:px-2"
              aria-current="page" href="customer/login.php" data-te-nav-link-ref>Login</a>
          </li>
        <?php endif?>

        <?php if (isset($_SESSION['user_name'])): ?>
          <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
            <div class="flex items-center">
              <div class="relative" data-te-dropdown-ref>
                <a class="flex items-center text-[#f2f4f3] transition duration-200 hover:text-[#7a0118] hover:ease-in-out focus:text-neutral-700 disabled:text-black/30 motion-reduce:transition-none lg:px-2 [&.active]:text-black/90"
                  href="#" type="button" id="dropdownMenuButton2" data-te-dropdown-toggle-ref aria-expanded="false">
                  <?php echo $_SESSION['user_name']; ?>
                  <span class="ml-2 w-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                      <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                    </svg>
                  </span>
                </a>
                <ul
                  class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg [&[data-te-dropdown-show]]:block"
                  aria-labelledby="dropdownMenuButton2" data-te-dropdown-menu-ref>
                  <li>
                    <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400"
                      href="customer/reservation_user.php" data-te-dropdown-item-ref>User Profile</a>
                  </li>
                  <li>
                    <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400"
                    href="index.php?logout='1'" data-te-dropdown-item-ref>Logout</a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
        <?php endif ?>  
      </ul>
  

        <div class="flex items-center px-5">
          <a type="button" data-te-ripple-init data-te-ripple-color="light" href="customer/reservation.php"
            class="mr-3 inline-block rounded bg-[#7a0118] px-8 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-300 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]">
            Reservation
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!--section Home-->
  <section class="mb-16 text-blue-900">
    <div id="carouselExampleIndicators" class="relative" data-te-carousel-init data-te-ride="carousel">
      <!--Carousel indicators-->
      <div class="absolute bottom-0 left-0 right-0 z-[2] mx-[15%] mb-4 flex list-none justify-center p-0"
        data-te-carousel-indicators>
        <button type="button" data-te-target="#carouselExampleIndicators" data-te-slide-to="0" data-te-carousel-active
          class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-te-target="#carouselExampleIndicators" data-te-slide-to="1"
          class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
          aria-label="Slide 2"></button>
        <button type="button" data-te-target="#carouselExampleIndicators" data-te-slide-to="2"
          class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
          aria-label="Slide 3"></button>
      </div>

      <!--Carousel items-->
      <div class="relative w-full overflow-hidden after:clear-both after:block after:content-['']">
        <!--First item-->
        <div
          class="relative float-left -mr-[100%] w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
          data-te-carousel-item data-te-carousel-active>
          <div class="relative overflow-hidden bg-cover bg-no-repeat" style="
        background-position: 50%;
        background-image: url('images/P9.JPG');
        height: 550px;
      " data-te-animation-init data-te-animation-start="onLoad" data-te-animation-reset="true"
            data-te-animation="[fade-in_1s_ease-in-out]">
            <div
              class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsla(0,0%,0%,0.65)] bg-fixed">
              <div class="flex h-full items-center justify-center">
                <div class="px-6 text-center text-white md:px-12" data-te-animation-init
                  data-te-animation-start="onLoad" data-te-animation-reset="true"
                  data-te-animation="[fade-in-up_1s_ease-in-out]">
                  <h1 class="mt-2 mb-16 text-5xl font-bold tracking-tight md:text-6xl xl:text-8xl">
                    RUBY<br /><span class="xl:text-5xl">Buffet Restaurant</span>
                  </h1>
                  <button type="button"
                    class="rounded border-2 border-[#f2f4f3] px-[46px] pt-[14px] pb-[12px] text-sm font-bold uppercase leading-normal text-neutral-50 transition duration-150 ease-in-out hover:border-[#f2f4f3] hover:bg-[#f2f4f3] hover:text-[#49111c]"
                    data-te-ripple-init data-te-ripple-color="light">
                    <a href="customer/reservation.php">Reservation</a>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Second item-->
        <div
          class="relative float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
          data-te-carousel-item>
          <div class="relative overflow-hidden bg-cover bg-no-repeat" style="
        background-position: 50%;
        background-image: url('images/P5.jpg');
        height: 550px;
      ">
            <div
              class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsla(0,0%,0%,0.65)] bg-fixed">
              <div class="flex h-full items-center justify-center">
                <div class="px-6 text-center text-white md:px-12">
                  <h1 class="mt-2 mb-16 text-5xl font-bold tracking-tight md:text-6xl xl:text-7xl">
                    MENU<br /><span class="text-3xl font-medium xl:text-5xl">
                      Good Food is Good Mood.</span>
                  </h1>
                  <button type="button"
                    class="rounded border-2 border-[#f2f4f3] px-[46px] pt-[14px] pb-[12px] text-sm font-bold uppercase leading-normal text-neutral-50 transition duration-150 ease-in-out hover:border-[#f2f4f3] hover:bg-[#f2f4f3] hover:text-[#49111c]"
                    data-te-ripple-init data-te-ripple-color="light">
                    <a href="customer/menu.php">OUR MENUS</a>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Third item-->
        <div
          class="relative float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
          data-te-carousel-item>
          <div class="relative overflow-hidden bg-cover bg-no-repeat" style="
        background-position: 50%;
        background-image: url('images/P3.jpg');
        height: 550px;
      ">
            <div
              class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsla(0,0%,0%,0.65)] bg-fixed">
              <div class="flex h-full items-center justify-center">
                <div class="px-6 text-center text-white md:px-12">
                  <h1 class="mt-2 mb-16 text-5xl font-bold tracking-tight md:text-6xl xl:text-7xl">
                    REGISTER<br /><span class="text-3xl font-medium xl:text-5xl">We cook meals and memories here.</span>
                  </h1>
                  <button type="button"
                    class="rounded border-2 border-[#f2f4f3] px-[46px] pt-[14px] pb-[12px] text-sm font-bold uppercase leading-normal text-neutral-50 transition duration-150 ease-in-out hover:border-[#f2f4f3] hover:bg-[#f2f4f3] hover:text-[#49111c]"
                    data-te-ripple-init data-te-ripple-color="light">
                    <a href="customer/login.php">LOGIN</a>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--section Speciality-->
  <section>
    <?php $query_menu = "SELECT * FROM menu WHERE category = 'Speciality'"; ?>
    <?php $result_menu = mysqli_query($connect, $query_menu) ?>
    <div class="container my-24 mx-auto md:px-6">
      <!-- Section: Design Block -->
      <section class="mb-32 text-center lg:text-left" data-te-animation-init data-te-animation-start="onScroll"
        data-te-animation-reset="true" data-te-animation="[fade-in_1s_ease-in-out]">
        <h2 class="mb-12 text-center text-7xl font-bold text-[#f2f4f3]">
          Speciality <span><img src="images/pumpkin.png" class="w-[100px] inline-block"></span>
        </h2>
        <div class="grid gap-x-6 lg:grid-cols-3">
          <?php for ($i = 0; $i <= 2; $i++): ?>
            <?php $row = mysqli_fetch_assoc($result_menu) ?>
            <div class="mb-12 lg:mb-0">
              <div class="relative mb-6 overflow-hidden rounded-lg">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']) ?>" class="w-full" />
              </div>
              <h5 class="mb-4 text-3xl font-bold text-[#f2f4f3] text-center">
                <?php echo $row['food_name'] ?>
              </h5>
            </div>
          <?php endfor ?>
        </div>
    </div>
  </section>
  </div>
  </section>

  <!--section menu2-->
  <section>
    <div class="pb-12 text-center md:px-12 lg:text-center" data-te-animation-init data-te-animation-start="onScroll"
      data-te-animation-reset="true" data-te-animation="[fade-in-left_1s_ease-in-out]">
      <div class="w-100 mx-auto sm:max-w-2xl md:max-w-3xl lg:max-w-5xl xl:max-w-full">
        <div class="grid items-center gap-12 lg:grid-cols-2">
          <div class="mb-12 hidden lg:block">
            <img src="images/P32.jpg" class="w-full shadow-lg" />
          </div>
          <div class="mt-12 lg:mt-0">
            <h2 class="mb-6 text-7xl font-bold text-[#f2f4f3]">
              MENU
            </h2>
            <p class="mb-6 pb-2 text-[#f2f4f3] text-xl">
              More than 55 delicious food menus from all over the world are ready to serve you for best experience. Hope
              you enjoy.<br> <span class="text-[#f2f4f3] text-2xl">-THB 1,390 per
                people-</span>
            </p>
            <a href="customer/menu.php">
            <button type="button"
              class="rounded border-2 border-[#f2f4f3] px-[46px] pt-[14px] pb-[12px] text-sm font-bold uppercase leading-normal text-[#f2f4f3] transition duration-300 ease-in-out hover:border-[#f2f4f3] hover:bg-[#f2f4f3] hover:bg-opacity-100 hover:text-[#49111c] focus:border-neutral-100 focus:text-neutral-100 focus:outline-none focus:ring-0 active:border-neutral-200 active:text-neutral-200"
              data-te-ripple-init data-te-ripple-color="light">
              MENU
            </button>
            </a>
          </div>
          <div class="mb-12 block lg:hidden flex justify-center">
            <img src="images/P32.JPG" class="w-full shadow-lg" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--section menu1-->
  <section>
    <div class="py-10 text-center md:px-12 lg:text-center" data-te-animation-init data-te-animation-start="onScroll"
      data-te-animation-reset="true" data-te-animation="[fade-in-right_1s_ease-in-out]">
      <div class="w-100 mx-auto sm:max-w-2xl md:max-w-3xl lg:max-w-5xl xl:max-w-full">
        <div class="grid items-center gap-12 lg:grid-cols-2">
          <div class="mt-12 lg:mt-0">
            <h2 class="mb-6 text-7xl font-bold text-[#f2f4f3]">
              OPENING TIME
            </h2>
            <ul class="w-3/4 lg:w-96 mb-6 pb-2 text-[#f2f4f3] text-xl mx-auto">
              <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4">
                <i class="fi fi-rr-room-service text-4xl"></i>
              </li>
              <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4">
                <i class="fi fi-rr-clock-ten text-2xl"><span class="ml-3">10:00 - 13:00</span></i>
              </li>
              <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4">
                <i class="fi fi-rr-clock-two text-2xl"><span class="ml-3">14:00 - 17:00</span></i>
              </li>
              <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4">
                <i class="fi fi-rr-clock-six text-2xl"><span class="ml-3">18:00 - 21:00</span></i>
              </li>
              <li class="w-full py-4">Take your time.</li>
            </ul>
            <a href="customer/reservation.php">
            <button type="button"
              class="rounded border-2 border-whittext-[#f2f4f3] px-[46px] pt-[14px] pb-[12px] text-sm font-bold uppercase leading-normal text-[#f2f4f3] transition duration-300 ease-in-out hover:border-[#f2f4f3] hover:bg-[#f2f4f3] hover:bg-opacity-100 hover:text-[#49111c] focus:border-neutral-100 focus:text-neutral-100 focus:outline-none focus:ring-0 active:border-neutral-200 active:text-neutral-200"
              data-te-ripple-init data-te-ripple-color="light">
              Reservation
            </button>
            </a>
          </div>
          <div class="mb-12 lg:mb-0 flex justify-center">
            <img src="images/P29.JPG" class="w-full shadow-lg" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--section Footer-->
  <section>
    <!--Footer container-->
    <footer class="flex flex-col items-center bg-[#0f0e0c] text-center text-white ">
      <div class="container pt-3">
        <div class="mb-2 flex justify-center">
          <a href="https://www.facebook.com/ITLadkrabang" class="mr-9 text-white ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
            </svg>
          </a>
          <a href="https://www.kmitl.ac.th/" class="mr-9 text-white ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M7 11v2.4h3.97c-.16 1.029-1.2 3.02-3.97 3.02-2.39 0-4.34-1.979-4.34-4.42 0-2.44 1.95-4.42 4.34-4.42 1.36 0 2.27.58 2.79 1.08l1.9-1.83c-1.22-1.14-2.8-1.83-4.69-1.83-3.87 0-7 3.13-7 7s3.13 7 7 7c4.04 0 6.721-2.84 6.721-6.84 0-.46-.051-.81-.111-1.16h-6.61zm0 0 17 2h-3v3h-2v-3h-3v-2h3v-3h2v3h3v2z"
                fill-rule="evenodd" clip-rule="evenodd" />
            </svg>
          </a>
          <a href="https://www.instagram.com/itladkrabang/" class="mr-9 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
            </svg>
          </a>
          <a href="https://github.com/" class="text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
            </svg>
          </a>
        </div>
      </div>

      <!--Copyright section-->
      <div class="w-full bg-[#0f0e0c] p-4 text-center text-white">
        © 2023 Copyright:
        <a class="text-white" href="https://www.it.kmitl.ac.th/th/program/datasci-program-2565/">ISAD Project</a>
      </div>
    </footer>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>
<?php mysqli_close($connect); ?>
</html>