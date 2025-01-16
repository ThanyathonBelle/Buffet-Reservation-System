<?php session_start();
    if (isset($_SESSION['user_name'])){
        header('location: index.php');
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

    <?php if(isset($_COOKIE["error_login"])):?>
        <script>
            Swal.fire({
                title: 'Login failed',
                text: '<?php echo $_COOKIE["error_login"];?>',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif ?>

    <?php if(isset($_COOKIE["error_reg"])):?>
        <script>
            Swal.fire({
                title: 'Register failed',
                text: '<?php echo $_COOKIE["error_reg"];?>',
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

    <!-- Login form -->
    <section class="h-screen">
        <div class="text-white text-5xl sm:text-7xl text-center pt-10">Login/Register</div>
        <div class="container h-full px-0 md:px-6 py-10 mx-auto">
            <div class="g-6 flex h-full flex-wrap items-center justify-center lg:justify-between">
                <!-- Left column container with background-->
                <div class="mb-12 w-full md:mb-0 md:w-8/12 lg:w-6/12">
                    <img src="../images/P33.png"
                        class="w-full rounded-2xl"/>
                </div>



                <!-- Right column container with form -->
                <div class="md:w-8/12 lg:ml-6 lg:w-5/12">
                    <ul class="mb-5 flex list-none flex-col flex-wrap pl-0 md:flex-row" id="pills-tab" role="tablist"
                        data-te-nav-ref>
                        <li role="presentation">
                            <a href="#pills-home"
                                class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-lg font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-[#7a0118] data-[te-nav-active]:text-white md:mr-4 transition duration-300 ease-in-out"
                                id="pills-home-tab" data-te-toggle="pill" data-te-target="#pills-home"
                                data-te-nav-active role="tab" aria-controls="pills-home" aria-selected="true">LOGIN</a>
                        </li>
                        <li role="presentation">
                            <a href="#pills-profile"
                                class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-lg font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-[#7a0118] data-[te-nav-active]:text-white md:mr-4 transition duration-300 ease-in-out"
                                id="pills-profile-tab" data-te-toggle="pill" data-te-target="#pills-profile" role="tab"
                                aria-controls="pills-profile" aria-selected="false">REGISTER</a>
                        </li>
                    </ul>

                    <!--Pills content-->
                    <div class="mb-6">
                        <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                            id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" data-te-tab-active>
                            <p class="mb-4 text-white">Please login to your account</p>
                            <form action = 'login_db.php' method ='post'>
                                <!-- username input -->
                                <div class="relative mb-6" data-te-input-wrapper-init>
                                    <input type="text"
                                        class="text-white peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        id="exampleFormControlInput3" placeholder="username" name="username" required/>
                                    <label for="exampleFormControlInput3"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-white peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Username
                                    </label>
                                </div>

                                <!-- Password input -->
                                <div class="relative mb-6" data-te-input-wrapper-init>
                                    <input type="password"
                                        class="text-white peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        id="exampleFormControlInput33" placeholder="Password" name="password" required/>
                                    <label for="exampleFormControlInput33"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-white peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Password
                                    </label>
                                </div>

                                <!-- Submit button -->
                                <button type="submit"
                                    class="inline-block w-full rounded bg-[#7a0118] px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-150 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]"
                                    data-te-ripple-init data-te-ripple-color="light" data-te-submit-btn-ref name='login_user'>
                                    SIGN IN
                                </button>
                            </form>
                        </div>
                        <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                            id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <p class="mb-4 text-white">Please register an account</p>
                            <form action = 'register_db.php' method ='post'>
                                <!-- User name input -->
                                <div class="relative mb-6" data-te-input-wrapper-init>
                                    <input type="text" name="username"
                                        class="text-white peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        placeholder="username" required
                                        pattern=".{5,}"
                                        />
                                        <span class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                                            &nbsp;&nbsp;&nbsp;*Please enter at least 5 characters
                                          </span>
                                    <label for="username"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-white peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Username</label>
                                </div>

                                <!-- Password input -->
                                <div class="relative mb-6" data-te-input-wrapper-init>
                                    <input type="password" name="password_1"
                                        class="text-white peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        placeholder="Password" required
                                        pattern=".{7,}"
                                        />
                                        <span class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                                            &nbsp;&nbsp;&nbsp;*Please enter at least 7 characters
                                          </span>
                                    <label for="password"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-white peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Password</label>
                                </div>

                                <!-- Confirm Password input -->
                                <div class="relative mb-6" data-te-input-wrapper-init>
                                    <input type="password" name="password_2"
                                        class="text-white peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        placeholder="Confirm Password" required
                                        pattern=".{7,}"
                                        />
                                        <span class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                                            &nbsp;&nbsp;&nbsp;*Please enter at least 7 characters
                                          </span>
                                    <label for="password"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-white peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Confirm Password</label>
                                </div>

                                <!-- Email input -->
                                <div class="relative mb-6" data-te-input-wrapper-init>
                                    <input type="email" name="email"
                                        class="text-white peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        placeholder="Email address" required
                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"/>
                                        <span class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                                            &nbsp;&nbsp;&nbsp;*Please enter a valid email address
                                          </span>
                                    <label for="email"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-white peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Email
                                        address</label>
                                </div>

                                <!-- Firstname input -->
                                <div class="relative mb-6" data-te-input-wrapper-init>
                                    <input type="text"
                                        class="text-white peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        placeholder="Firstname" name="fname" required/>
                                    <label for="exampleFormControlInput33"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-white peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Firstname
                                    </label>
                                </div>

                                <!-- Lastname input -->
                                <div class="relative mb-6" data-te-input-wrapper-init>
                                    <input type="text"
                                        class="text-white peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        placeholder="Lastname" name="lname" required/>
                                    <label for="exampleFormControlInput33"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-white peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Lastname
                                    </label>
                                </div>

                                <!-- Tel input -->
                                <div class="relative mb-6" data-te-input-wrapper-init>
                                    <input type="tel" name="phone"
                                        class="text-white peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                        placeholder="Phone number" pattern="0[0-9]{9}" required/>
                                        <span class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                                            &nbsp;&nbsp;&nbsp;*Please enter your phone number
                                          </span>
                                    <label for="tel"
                                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-white peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Phone
                                        number</label>
                                </div>

                                <!-- Submit button -->
                                <button type="submit"
                                    class="inline-block w-full rounded bg-[#7a0118] px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#2b030b] transition duration-150 ease-in-out hover:bg-[#570111] hover:shadow-[0_8px_9px_-4px_rgba(191,78,88,0.3),0_4px_18px_0_rgba(191,78,88,0.2)]"
                                    data-te-ripple-init data-te-ripple-color="light" name="reg_user">
                                    SIGN UP
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>
</html>