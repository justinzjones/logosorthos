<div x-data="{ open: false }">
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
    <header class="absolute inset-x-0 top-0 z-50">
        <nav aria-label="Global" class="flex items-center justify-between p-6 lg:px-8">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img alt="" src="{{ asset('assets/logo.svg') }}" class="w-auto h-8 bg-transparent">
                </a>
            </div>
            <div class="flex lg:hidden">
                <button @click="open = ! open" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400"><span class="sr-only">Open main menu</span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="/" class="font-semibold text-white text-sm/6">Home</a>
                <a href="/news" class="font-semibold text-white text-sm/6">News</a>
                <a href="/travel" class="font-semibold text-white text-sm/6">Travel</a>
                <a href="/finance" class="font-semibold text-white text-sm/6">Finance</a>
                <a href="/history" class="font-semibold text-white text-sm/6">History</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="#" class="font-semibold text-white text-sm/6"><span aria-hidden="true"></span></a>
            </div>
        </nav>


        <div>
            <div    x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
                    x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
                    class="lg:hidden" role="dialog" tabindex="-1" aria-modal="true">
                <div class="fixed inset-0 z-50"></div>
                <div class="fixed inset-y-0 right-0 z-50 w-full px-6 py-6 overflow-y-auto bg-gray-900 sm:max-w-sm sm:ring-1 sm:ring-white/10" id="headlessui-dialog-panel-:rv:">
                    <div class="flex items-center justify-between"><a href="#" class="-m-1.5 p-1.5"><span class="sr-only">Your Company</span><img alt="" src="{{ asset('assets/logo.svg') }}" class="w-auto h-8 bg-transparent"></a>
                        <button @click="open = ! open" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-400"><span class="sr-only">Close menu</span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flow-root mt-6">
                        <div class="-my-6 divide-y divide-gray-500/25">
                            <div class="py-6 space-y-2">
                                <a href="/" class="block px-3 py-2 -mx-3 font-semibold text-white rounded-lg text-base/7 hover:bg-gray-800">Home</a>
                                <a href="/news" class="block px-3 py-2 -mx-3 font-semibold text-white rounded-lg text-base/7 hover:bg-gray-800">News</a>
                                <a href="/travel" class="block px-3 py-2 -mx-3 font-semibold text-white rounded-lg text-base/7 hover:bg-gray-800">Travel</a>
                                <a href="/finance" class="block px-3 py-2 -mx-3 font-semibold text-white rounded-lg text-base/7 hover:bg-gray-800">Finance</a>
                                <a href="/history" class="block px-3 py-2 -mx-3 font-semibold text-white rounded-lg text-base/7 hover:bg-gray-800">History</a>
                            </div>
        
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </header>







</div>