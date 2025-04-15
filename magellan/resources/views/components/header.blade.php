<div class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm" x-data="{ open: false, menu: window.location.pathname.split('/')[1].toLowerCase() }">
    <div x-show="open" class="relative z-40 lg:hidden" x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state." x-ref="dialog" aria-modal="true">

    <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Off-canvas menu backdrop, show/hide based on off-canvas menu state." class="fixed inset-0 bg-black bg-opacity-25" aria-hidden="true"></div>


    <div @keydown.window.escape="open = false" class="flex fixed inset-0 z-40">

      <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" x-description="Off-canvas menu, show/hide based on off-canvas menu state." class="flex overflow-y-auto relative flex-col pb-12 w-full max-w-xs bg-white shadow-xl" @click.away="open = false">
        <div class="flex px-4 pt-5 pb-2">
          <button type="button" class="inline-flex justify-center items-center p-2 -m-2 text-gray-400 rounded-md" 
            @click="open = false">
            <span class="sr-only">Close menu</span>
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <!-- Links -->


        <div class="px-0 py-0 space-y-6 border-t border-gray-200">
        <div class="pt-0 pb-0 space-y-1">
        <!-- Current: "bg-indigo-50 border-indigo-500 text-indigo-700", Default: "border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700" -->
       





        <a href="/"
                      @click="menu = 'home'"
                      class="block py-2 pr-4 pl-3 text-base font-medium"
                      x-bind:class="{ 
                'text-gray-500 border-l-4 border-transparent hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700': menu !== '', 
                'border-l-4 text-hippie-blue-700 border-hippie-blue-500 bg-hippie-blue-100':  menu === '' 
              }">Home
        </a>

        <a href="/news"
                      @click="menu = 'news'"
                      class="block py-2 pr-4 pl-3 text-base font-medium"
                      x-bind:class="{ 
                'text-gray-500 border-l-4 border-transparent hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700': menu !== 'news', 
                'border-l-4 text-hippie-blue-700 border-hippie-blue-500 bg-hippie-blue-100':  menu === 'news' 
              }">News
        </a>

        

        <a href="/finance"
                      @click="menu = 'finance'"
                      class="block py-2 pr-4 pl-3 text-base font-medium"
                      x-bind:class="{ 
                'text-gray-500 border-l-4 border-transparent hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700': menu !== 'finance', 
                'border-l-4 text-hippie-blue-700 border-hippie-blue-500 bg-hippie-blue-100':  menu === 'finance' 
              }">Finance
        </a>

        <a href="/aviation"
                      @click="menu = 'aviation'"
                      class="block py-2 pr-4 pl-3 text-base font-medium"
                      x-bind:class="{ 
                'text-gray-500 border-l-4 border-transparent hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700': menu !== 'aviation', 
                'border-l-4 text-hippie-blue-700 border-hippie-blue-500 bg-hippie-blue-100':  menu === 'aviation' 
              }">Aviation
        </a>

        <a href="/history"
                      @click="menu = 'history'"
                      class="block py-2 pr-4 pl-3 text-base font-medium"
                      x-bind:class="{ 
                'text-gray-500 border-l-4 border-transparent hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700': menu !== 'history', 
                'border-l-4 text-hippie-blue-700 border-hippie-blue-500 bg-hippie-blue-100':  menu === 'history' 
              }">History
        </a>

        <a href="/discovery"
                      @click="menu = 'discovery'"
                      class="block py-2 pr-4 pl-3 text-base font-medium"
                      x-bind:class="{ 
                'text-gray-500 border-l-4 border-transparent hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700': menu !== 'discovery', 
                'border-l-4 text-hippie-blue-700 border-hippie-blue-500 bg-hippie-blue-100':  menu === 'discovery' 
              }">Discovery
        </a>
      
      
      </div>

        </div>

        <!-- <div class="px-4 py-6 space-y-6 border-t border-gray-200">
          <div class="flow-root">
            <a href="#" class="block p-2 -m-2 font-medium text-gray-900">Create an account</a>
          </div>
          <div class="flow-root">
            <a href="#" class="block p-2 -m-2 font-medium text-gray-900">Sign in</a>
          </div>
        </div> -->


      </div>

    </div>
  </div>

  <header>
    <nav aria-label="Top">
      <!-- Top navigation -->



      <!-- Secondary navigation -->
      <div class="bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="flex justify-between items-center h-16">
              <!-- Logo (lg+) -->
              <div class="hidden lg:flex lg:flex-1 lg:items-center">
                <a href="/">
                  <span class="sr-only">Your Company</span>
                  <!-- <img class="w-auto h-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&amp;shade=600" alt=""> -->
                  <img class="w-auto h-11" src="{{ asset('assets/logo.svg') }}" alt="">
                </a>
              </div>

              <div class="hidden h-full lg:flex">
                <!-- Flyout menus -->
                <div class="inset-x-0 bottom-0 px-4" x-data="Components.popoverGroup()" x-init="init()">
                  <div class="flex gap-x-8 justify-center h-full">
                    <div class="flex" x-data="Components.popover({ open: true, focus: false })" x-init="init()" @keydown.escape="onEscape" @close-popover-group.window="onClosePopoverGroup">



                      <div x-show="open" x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
                      x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
                      flyout menu, show/hide based on flyout menu state." 
                      class="absolute inset-x-0 top-full text-sm text-gray-500" x-ref="panel" @click.away="open = false" style="display: none;">
                        <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                        <div class="absolute inset-0 top-1/2 bg-white shadow" aria-hidden="true"></div>

                        <div class="flex" x-data="Components.popover({ open: false, focus: false })" x-init="init()" @keydown.escape="onEscape" @close-popover-group.window="onClosePopoverGroup">
                      </div>

                    </div>
                    

                    </div>

                    <!-- Home -->
                    <a href="/"
                      @click="menu = 'home'"
                      class="inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2"
                      x-bind:class="{ 
                'hover:border-gray-300 hover:text-gray-700 text-gray-500 border-transparent': menu !== '', 
                'text-gray-900 border-hippie-blue-400':  menu === '' 
              }">Home</a>

                    <!-- News -->
                    <a href="/news"
                      @click="menu = 'news'"
                      class="inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2"
                      x-bind:class="{ 
                'hover:border-gray-300 hover:text-gray-700 text-gray-500 border-transparent': menu !== 'news', 
                'text-gray-900 border-hippie-blue-400':  menu === 'news' 
              }">News</a>

                    <a href="/finance"
                      @click="menu = 'finance'"
                      class="inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2"
                      x-bind:class="{ 
                          'hover:border-gray-300 hover:text-gray-700 text-gray-500 border-transparent': menu !== 'finance', 
                          'text-gray-900 border-hippie-blue-400':  menu === 'finance' 
                        }">Finance
                    </a>

                    <a href="/aviation"
                      @click="menu = 'aviation'"
                      class="inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2"
                      x-bind:class="{ 
                          'hover:border-gray-300 hover:text-gray-700 text-gray-500 border-transparent': menu !== 'aviation', 
                          'text-gray-900 border-hippie-blue-400':  menu === 'aviation' 
                        }">Aviation
                    </a>

                    <a href="/history"
                      @click="menu = 'history'"
                      class="inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2"
                      x-bind:class="{ 
                          'hover:border-gray-300 hover:text-gray-700 text-gray-500 border-transparent': menu !== 'history', 
                          'text-gray-900 border-hippie-blue-400':  menu === 'history' 
                        }">History
                    </a>

                                        <!-- Discovery -->
                      <a href="/discovery"
                      @click="menu = 'discovery'"
                      class="inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2"
                      x-bind:class="{ 
                          'hover:border-gray-300 hover:text-gray-700 text-gray-500 border-transparent': menu !== 'discovery', 
                          'text-gray-900 border-hippie-blue-400':  menu === 'discovery' 
                        }">Discovery
                      </a>
                    <!-- this div is needed to center the menu -->
                    <div></div>

                  </div>
                </div>
              </div>

              <!-- Mobile menu and search (lg-) -->
              <div class="flex flex-1 items-center lg:hidden">
                <button type="button" x-description="Mobile menu toggle, controls the 'mobileMenuOpen' state." class="p-2 -ml-2 text-gray-400 bg-white rounded-md" @click="open = true">
                  <span class="sr-only">Open menu</span>
                  <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                  </svg>
                </button>

                <!-- Search -->
                <a href="#" class="p-2 ml-2 text-gray-400 hover:text-gray-500">
                  <span class="sr-only">Search</span>
                  <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                  </svg>
                </a>
              </div>

              <!-- Logo (lg-) -->
              <a href="/" class="lg:hidden">
                <span class="sr-only">Your Company</span>
                <!-- <img src="https://tailwindui.com/img/logos/mark.svg?color=indigo&amp;shade=600" alt="" class="w-auto h-8"> -->
                <img class="w-auto h-11" src="{{ asset('assets/logo.svg') }}" alt="">
              </a>

              <div class="flex flex-1 justify-end items-center">
                <a href="#" class="hidden invisible text-sm font-medium text-gray-700 hover:text-gray-800 lg:block">Search</a>

                <div class="flex items-center lg:ml-8">
                  <!-- Help -->
                  <a href="#" class="invisible p-2 text-gray-400 hover:text-gray-500 lg:hidden">
                    <span class="sr-only">Help</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"></path>
                    </svg>
                  </a>
                  <a href="#" class="hidden invisible text-sm font-medium text-gray-700 hover:text-gray-800 lg:block">Help</a>

                  <!-- Cart -->
                  <div class="flow-root invisible ml-4 lg:ml-8">
                    <a href="#" class="flex items-center p-2 -m-2 group">
                      <svg class="flex-shrink-0 w-6 h-6 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
                      </svg>
                      <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">0</span>
                      <span class="sr-only">items in cart, view bag</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>

        </div>
      </div>
    </nav>
  </header>
</div>