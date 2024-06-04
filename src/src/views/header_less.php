 <header class=" fixed top-0 left-0 w-full h-24 z-40 bg-white ">
     <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:divide-y lg:divide-teal-700 lg:px-8">
         <div class="relative flex h-16 justify-between">
             <div class="relative z-10 flex px-2 lg:px-0">
                 <a href="/login">
                     <img class="h-16 w-auto" src="<?php echo $this->createPath('/var/www/html/src/imgs/_70f80b3a-ebba-4301-b282-d658e291eaf2.jpg') ?>" alt="Your Company">
                 </a>

             </div>
           
             <div class="relative z-10 flex items-center lg:hidden">
                 <!-- Mobile menu button -->
                 <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                     <span class="absolute -inset-0.5"></span>
                     <span class="sr-only">Open menu</span>
                     <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
                     <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                     </svg>
                     <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
                     <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                     </svg>
                 </button>
             </div>
             <div class="hidden lg:relative lg:z-10 lg:ml-4 lg:flex lg:items-center">
                 <a href="/logout">
                     <button type="button" class="relative flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                         <span class="absolute -inset-1.5"></span>
                         <span class="sr-only">View notifications</span>
                         <img class="h-8 w-auto" src="<?php echo $this->createPath('//var/www/html/src/imgs/_d1e286cd-fbbe-45a6-8823-730f39979c08.jpg') ?>" alt="Your Company">
                     </button>
                 </a>
                 <?php if (isset($locations)) : ?>
                     <!-- Profile dropdown -->
                     <div class="relative ml-4 flex-shrink-0">
                         <div>
                             <button type="button" class="relative flex rounded-full bg-gray-800 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                 <span class="absolute -inset-1.5"></span>
                                 <span class="sr-only">Open user menu</span>
                                 <img class="h-8 w-8 rounded-full" src="<?php echo $this->createPath($user[0]['file_path']) ?>" alt="">
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
                         <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                             <!-- Active: "bg-gray-100", Not Active: "" -->

                         </div>
                     </div>
                 <?php endif; ?>
             </div>
         </div>
 </header>
