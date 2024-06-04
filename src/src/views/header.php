         <header class=" fixed top-0 left-0 w-full h-20 z-30  ">
             <div id="container" class="mx-auto max-w-7xl px-2 sm:px-4 lg:divide-y lg:divide-teal-700 lg:px-8">
                 <div class="relative flex h-16 justify-between">
                     <div class="relative z-10 flex px-2 lg:px-0">
                         <div class="flex flex-shrink-0 items-center">
                             <a href="#" id="loginLink" class="invert-0 hover:invert">
                                 <img class="h-12 w-auto" src="<?php echo $this->createPath('/var/www/html/src/imgs/_70f80b3a-ebba-4301-b282-d658e291eaf2.jpg') ?>" alt="Your Company">
                             </a>

                             <form id="loginForm" action="/login" method="post" style="display: none;">
                                 <input type="hidden" name="windowWidth" class="windowWidthInput">
                                 <input type="hidden" name="windowHeight" class="windowHeightInput">
                             </form>
                             <!-- <button id="login" class=" invert-0 hover:invert">
                                 <img class="h-16 w-auto  " src="<?php echo $this->createPath('/var/www/html/src/imgs/_70f80b3a-ebba-4301-b282-d658e291eaf2.jpg') ?>" alt="Your Company">
                             </button> -->
                         </div>

                     </div>
                     <div id="search" class="relative z-0 flex flex-1 items-center justify-center px-2 sm:absolute sm:inset-0">
                         <div class="w-full sm:max-w-xs">
                             <label for="search" class="sr-only">Search</label>
                             <div class="relative">
                                 <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                     <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                         <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                     </svg>
                                 </div>
                                 <form action="/search" method="GET">
                                     <input id="search" name="search" class="block w-full rounded-md border-0 bg-teal-500 py-1.5 pl-10 pr-3 text-yellow-300 placeholder:text-yellow-400 focus:bg-white focus:text-gray-900 focus:ring-0 focus:placeholder:text-gray-500 sm:text-sm sm:leading-6" placeholder="Search" type="search">
                                 </form>
                             </div>
                         </div>
                     </div>
                     <div class="relative z-10 flex items-center lg:hidden">
                         <!-- Mobile menu button -->


                         <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
                         <ul id="ore" class=" ore translate-x-full  fixed top-0 left-0 z-0 w-full  text-center text-xl font-bold   transition-all ease-linear list-none">
                             <div id="accordionSmall" class="flex justify-center ">
                                 <li class="locationHide block rounded-md py-2 px-3 text-base font-medium w-full  list-none">
                                     <h3 class="smallLocationButtn form_buttn bg-yellow-400 inline   hover:text-cyan-500  items-center justify-center rounded-md py-2 px-3 w-full h-10 text-sm font-medium " data-target="formLocation">部屋を登録</h3>
                                     <div id="formLocation" class="formLocation ore hidden content w-full h-auto rounded-lg  sm:w-50  xl:p-0 p-4  mx-auto z-50">
                                         <form id="" enctype="multipart/form-data" class="uploadFormLocation location_form ">
                                             <div>
                                                 <input type="text" name="location" id="location" class="cursor-pointer border border-yellow-400  text-gray-900 sm:text-sm rounded-lg  focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ロケーション名を入力" required="">
                                             </div>
                                             <div>
                                                 <div class="mb-3">
                                                     <input type="file" class="cursor-pointer border border-yellow-400 mt-3 p-3 rounded-lg bg-gray-50 " name="image" id="image">
                                                 </div>
                                             </div>
                                             <div class="mx-auto w-max">
                                                 <button type="button" id="" class="uploadLocation w-full text-white bg-black hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" value="small">送信</button>
                                             </div>
                                         </form>
                                     </div>
                                 </li>
                                 <li class="registerHide text-gray-300  hover:text-white block rounded-md py-2 px-3 text-base font-medium w-full mr-10 list-none" style="width: 100% !important;">
                                     <h3 class=" smallRegisterButtn register form_buttn bg-yellow-400 hover:text-cyan-500 inline items-center justify-center rounded-md py-2 px-3 w-full h-10 text-sm font-medium cursor-pointer" data-target="formRegister">アイテムを登録</h3>
                                     <div id="formRegister" class="ore hidden  content w-full h-72 rounded-lg shadow dark:border  xl:p-0 p-4 dark:bg-gray-800 dark:border-black">
                                         <form id="" class="smallUploadFormRegister register_form  space-y-4 md:space-y-6 " enctype="multipart/form-data">
                                             <div class="cursor-pointer">
                                                 <textarea rows="5" cols="20" name="other" id="other" class="cursor-pointer bg-gray-50 border border-yellow-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 resize-none text-left" placeholder="メモを入力" required></textarea>
                                             </div>
                                             <div class="cursor-pointer">
                                                 <input class="cursor-pointer border border-yellow-400 p-3 rounded-lg bg-gray-50" type="file" name="image" required>
                                                 <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                                             </div>
                                             <div class="mx-auto w-max ">
                                                 <input type="button" id="" value="送信" class="smallUploadRegister text-white bg-black hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 cursor-pointer">
                                             </div>
                                         </form>
                                     </div>
                                 </li>
                             </div>
                         </ul>
                         <button type="button" id="omae" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none " aria-controls="mobile-menu" aria-expanded="false"> <svg id="inputButtn" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                             </svg>
                         </button>

                         <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
                         <!-- <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                             </svg> -->
                         <button id="closeButtn" class="hidden relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white">
                             <img src="<?php echo $this->createPath('/var/www/html/src/imgs/細いバツのアイコン.jpeg') ?>" alt="" class="">
                     </div>
                     <div class="hidden lg:relative lg:z-10 lg:ml-4 lg:flex lg:items-center">
                         <a href="/logout" class=" hover:saturate-150">
                             <!-- <button type="button" class="relative flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"> -->
                             <!-- <span class="absolute -inset-1.5">ログアウト</span> -->
                             <!-- <span class="sr-only">ログアウト</span> -->
                             <img class="h-16  hover:backdrop-contrast-150" src="<?php echo $this->createPath('/var/www/html/src/imgs/_b4eb111d-3415-4e44-8ad7-8155acc5a0b8.jpg') ?>" alt="Your Company">
                             <!-- </button> -->
                         </a>
                         <?php if (isset($locations)) : ?>
                             <!-- Profile dropdown -->
                             <div class="relative ml-4 flex-shrink-0">
                                 <div>
                                     <button type="button" class="relative flex rounded-full bg-gray-800 text-sm text-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                         <span class="absolute -inset-1.5"></span>
                                         <span class="sr-only">Open user menu</span>
                                     </button>
                                 </div>

                                 <!--
            Dropdown menu, show/hide based on menu state.

            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->

                             </div>
                         <?php endif; ?>
                     </div>
                 </div>
                 <nav id="function" class=" lg:flex lg:justify-between lg:space-x-8 lg:py-2 hidden lg:block " aria-label=" Global">
                     <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                     <div id="accordion" class="flex">
                         <h3 class="locationButtn form_buttn wideLocationButtn bg-yellow-400 hover:bg- hover:text-cyan-500 inline items-center justify-center rounded-md py-2 px-3 w-30 h-10 text-sm font-medium cursor-pointer" data-target="formLocation">部屋を登録</h3>
                         <div class="formLocation hidden content z-50 w-full h-auto rounded-lg h-32 shadow dark:border sm:max-w-md xl:p-0 p-4 dark:bg-gray-800 dark:border-black z-50">
                             <form id="uploadFormLocation" enctype="multipart/form-data" class="uploadFormLocation location_form">
                                 <div>
                                     <input type="text" name="location" id="location" class="cursor-pointer border border-yellow-400 bg-gray-50 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" placeholder="ロケーション名を入力" required="">
                                 </div>
                                 <div>
                                     <div class="mb-3">
                                         <input type="file" class="cursor-pointer border border-yellow-400 mt-3 p-3 rounded-lg bg-gray-50" name="image" id="image">
                                     </div>
                                 </div>
                                 <button type="button" id="uploadLocation" class="uploadLocation w-1/2 text-white bg-black hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5" value="wide">送信</button>
                             </form>
                         </div>
                         <h3 class="register form_buttn registerButtn hover:text-cyan-500 inline-flex items-center justify-center rounded-md py-2 px-3 h-10 w-30 text-sm font-medium cursor-pointer mx-6" data-target="formRegister">アイテムを登録</h3>
                         <div id="formRegister" class="formRegister content hidden w-full h-80 rounded-lg shadow dark:border sm:max-w-md xl:p-0 p-4 dark:bg-gray-800 dark:border-black z-20">
                             <form id="" class="wideUploadFormRegister register_form space-y-4 md:space-y-6" enctype="multipart/form-data">
                                 <div class="cursor-pointer">
                                     <textarea rows="5" cols="20" name="other" id="other" class="cursor-pointer bg-gray-50 border border-yellow-400 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 resize-none text-left" placeholder="メモを入力" required></textarea>
                                 </div>
                                 <div class="cursor-pointer">
                                     <input class="cursor-pointer border border-yellow-400 p-3 rounded-lg bg-gray-50" type="file" name="image" required>
                                     <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                                 </div>
                                 <div class="mx-auto w-max cursor-pointer">
                                     <input type="button" id="" value="送信" class="wideUploadRegister text-white bg-black hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 cursor-pointer">
                                 </div>
                             </form>
                         </div>
                     </div>

                     <?php if (isset($locations)) : ?>
                         <div id="userLocation" class="hidden">
                             <p id="prevBtn" class="prevBtn text-black bg-yellow-400 hover:bg-cyan-500 hover:text-yellow-400 inline-flex items-center rounded-md py-2 px-3 text-sm font-mediu  opacity-75 cursor-pointer">前ののロケーション</p>
                             <a href=" #" class="bg-gray-900 text-white inline-flex items-center rounded-md py-2 px-3 text-sm font-medium" aria-current="page"><?php echo $user['name']; ?>の<span class="header_locationname"><?php echo $locations['location']; ?></span></a>
                             <p id="nextBtn" class="nextBtn text-black bg-yellow-400 hover:bg-cyan-500 hover:text-yellow-400 inline-flex items-center rounded-md py-2 px-3 text-sm font-medium  opacity-75 cursor-pointer">次ののロケーション </p>
                         </div>
                     <?php endif; ?>
                 </nav>



                 <!-- Mobile menu, show/hide based on menu state. -->
                 <nav class="lg:hidden" aria-label="Global" id="mobile-menu">


                 </nav>
             </div>
             <div id="userLocation" class="moveLocation lg:hidden z-30 text-center fixed top-16 left-0 sm:left-36 whitespace-nowrap">
                 <p class="z-30 prevBtn text-black bg-yellow-400 hover:bg-cyan-500 hover:text-yellow-400 inline-flex items-center rounded-md py-1 px-2 text-xs font-medium opacity-75 cursor-pointer">
                     前ロケーション
                 </p>
                 <a href="#" class="bg-teal-500 text-black inline-flex items-center rounded-md py-1 px-2 text-xs font-medium" aria-current="page">
                     <?php echo $user['name']; ?>の<span class="header_locationname"><?php echo $locations['location']; ?></span>
                 </a>
                 <p class="nextBtn text-black bg-yellow-400 hover:bg-cyan-500 hover:text-yellow-400 inline-flex items-center rounded-md py-1 px-2 text-xs font-medium opacity-75 cursor-pointer">
                     次ロケーション
                 </p>
                 <p class="text-black bg-yellow-400  hover:bg-red-600 hover:text-sky-500 inline-flex items-center rounded-md py-1 px-2 text-xs font-medium opacity-75 cursor-pointer">
                     <a href="/logout"> ログアウト </a>
                 </p>
             </div>
         </header>

         <!-- <div class="hidden sm:block" id="imageContainer"></div>
         <div id="loading" class="flex justify-center hidden" aria-label="読み込み中">
             <div class="animate-spin h-10 w-10 border-4 border-blue-500 rounded-full border-t-transparent"></div>
         </div> -->
