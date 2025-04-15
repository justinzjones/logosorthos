
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
     
<div class="py-10 bg-white sm:py-10">
  <div class="px-6 mx-auto max-w-6xl lg:px-8">
    <div class="max-w-3xl text-left">
      <h2 class="text-3xl font-semibold tracking-tight text-gray-900 text-balance sm:text-2xl">Overview</h2>
      <p class="mt-2 text-gray-600 text-lg/8">{{ $location->description }}</p>
    </div>
    @php
    $count = count($location->fk_place); // Total number of places
    $gridCols = $count == 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3'; // 4 columns if there are 4 items, otherwise 3
@endphp

@php
    $count = count($location->fk_place); // Total number of places
    $gridCols = $count == 1 ? 'lg:grid-cols-1' : ($count == 2 ? 'lg:grid-cols-2' : ($count == 5 ? 'lg:grid-cols-6' : ($count == 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3'))); // Dynamic columns
@endphp

<div class="grid max-w-2xl grid-cols-1 gap-8 mx-auto mt-16 auto-rows-fr sm:mt-8 lg:mx-0 lg:max-w-none {{ $gridCols }}">
    @foreach ($location->fk_place as $index => $place)
        @php
            $spanClass = '';

            if ($count == 1) {
                $spanClass = 'lg:col-span-1'; // Full width for single item
            } elseif ($count == 2) {
                $spanClass = 'lg:col-span-1'; // Each item takes a single column in a 2-column layout
            } elseif ($count == 4) {
                $spanClass = 'lg:col-span-2'; // All items span 2 columns for 4 items
            } elseif ($count == 5) {
                if ($index == 0 || $index == 1) {
                    $spanClass = 'lg:col-span-3'; // First two items span 3 columns each
                } else {
                    $spanClass = 'lg:col-span-2'; // Remaining three items span 2 columns each
                }
            }
        @endphp

        <article class="relative flex flex-col justify-end px-8 pb-8 overflow-hidden isolate rounded-2xl pt-80 sm:pt-48 lg:pt-80 {{ $spanClass }}">
            <!-- Image -->
            <img src="{{ directus_asset($place->hero) }}" alt="" class="object-cover absolute inset-0 w-full h-full -z-10">
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t via-transparent -z-10 from-gray-900/70"></div>
            
            <!-- Ring overlay -->
            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset -z-10 ring-gray-900/10"></div>
            
            <!-- Text Content -->
            <h3 class="mt-3 font-semibold text-white text-lg/6">
                <a href="#">
                    <span class="absolute inset-0"></span>
                    {{ $place->name }}
                </a>
            </h3>
        </article>
    @endforeach
</div>


<!-- 
    <div class="relative z-10 pb-20 mt-32 bg-gray-900 sm:mt-56 sm:pb-24 xl:pb-0">
      <div class="overflow-hidden absolute inset-0" aria-hidden="true">
        <div class="absolute left-[calc(50%-19rem)] top-[calc(50%-36rem)] transform-gpu blur-3xl">
          <div class="aspect-[1097/1023] w-[68.5625rem] bg-gradient-to-r from-[#ff4694] to-[#776fff] opacity-25" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
      </div>
      <div class="flex flex-col gap-x-8 gap-y-10 items-center px-6 mx-auto max-w-7xl sm:gap-y-8 lg:px-8 xl:flex-row xl:items-stretch">
        <div class="-mt-8 w-full max-w-2xl xl:-mb-8 xl:w-96 xl:flex-none">
          <div class="relative aspect-[2/1] h-full md:-mx-8 xl:mx-0 xl:aspect-auto">
            <img class="object-cover absolute inset-0 bg-gray-800 rounded-2xl shadow-2xl size-full" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2102&q=80" alt="">
          </div>
        </div>
        <div class="w-full max-w-2xl xl:max-w-none xl:flex-auto xl:px-16 xl:py-24">
          <figure class="isolate relative pt-6 sm:pt-12">
            <svg viewBox="0 0 162 128" fill="none" aria-hidden="true" class="absolute top-0 left-0 h-32 -z-10 stroke-white/20">
              <path id="b56e9dab-6ccb-4d32-ad02-6b4bb5d9bbeb" d="M65.5697 118.507L65.8918 118.89C68.9503 116.314 71.367 113.253 73.1386 109.71C74.9162 106.155 75.8027 102.28 75.8027 98.0919C75.8027 94.237 75.16 90.6155 73.8708 87.2314C72.5851 83.8565 70.8137 80.9533 68.553 78.5292C66.4529 76.1079 63.9476 74.2482 61.0407 72.9536C58.2795 71.4949 55.276 70.767 52.0386 70.767C48.9935 70.767 46.4686 71.1668 44.4872 71.9924L44.4799 71.9955L44.4726 71.9988C42.7101 72.7999 41.1035 73.6831 39.6544 74.6492C38.2407 75.5916 36.8279 76.455 35.4159 77.2394L35.4047 77.2457L35.3938 77.2525C34.2318 77.9787 32.6713 78.3634 30.6736 78.3634C29.0405 78.3634 27.5131 77.2868 26.1274 74.8257C24.7483 72.2185 24.0519 69.2166 24.0519 65.8071C24.0519 60.0311 25.3782 54.4081 28.0373 48.9335C30.703 43.4454 34.3114 38.345 38.8667 33.6325C43.5812 28.761 49.0045 24.5159 55.1389 20.8979C60.1667 18.0071 65.4966 15.6179 71.1291 13.7305C73.8626 12.8145 75.8027 10.2968 75.8027 7.38572C75.8027 3.6497 72.6341 0.62247 68.8814 1.1527C61.1635 2.2432 53.7398 4.41426 46.6119 7.66522C37.5369 11.6459 29.5729 17.0612 22.7236 23.9105C16.0322 30.6019 10.618 38.4859 6.47981 47.558L6.47976 47.558L6.47682 47.5647C2.4901 56.6544 0.5 66.6148 0.5 77.4391C0.5 84.2996 1.61702 90.7679 3.85425 96.8404L3.8558 96.8445C6.08991 102.749 9.12394 108.02 12.959 112.654L12.959 112.654L12.9646 112.661C16.8027 117.138 21.2829 120.739 26.4034 123.459L26.4033 123.459L26.4144 123.465C31.5505 126.033 37.0873 127.316 43.0178 127.316C47.5035 127.316 51.6783 126.595 55.5376 125.148L55.5376 125.148L55.5477 125.144C59.5516 123.542 63.0052 121.456 65.9019 118.881L65.5697 118.507Z" />
              <use href="#b56e9dab-6ccb-4d32-ad02-6b4bb5d9bbeb" x="86" />
            </svg>
            <blockquote class="font-semibold text-white text-xl/8 sm:text-2xl/9">
              <p>Gravida quam mi erat tortor neque molestie. Auctor aliquet at porttitor a enim nunc suscipit tincidunt nunc. Et non lorem tortor posuere. Nunc eu scelerisque interdum eget tellus non nibh scelerisque bibendum.</p>
            </blockquote>
            <figcaption class="mt-8 text-base">
              <div class="font-semibold text-white">Judith Black</div>
              <div class="mt-1 text-gray-400">CEO of Tuple</div>
            </figcaption>
          </figure>
        </div>
      </div>
    </div> -->
<div>
  <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 sm:py-6 lg:px-0">
    <div class="sm:flex sm:items-baseline sm:justify-between">
      <h2 class="text-3xl font-semibold tracking-tight text-gray-900 text-balance sm:text-2xl">Itinerary idea</h2>
        <a href="#" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
          Browse all hotels
          <span aria-hidden="true"> &rarr;</span>
        </a>
    </div>
  </div>
  
  <div class="flow-root">
    <ul role="list" class="-mb-8">
      <li>
        <div class="relative pb-8">
          <span class="absolute top-4 left-4 -ml-px w-0.5 h-full bg-gray-200" aria-hidden="true"></span>
          <div class="flex relative space-x-3">
            <div>
              <span class="flex justify-center items-center bg-gray-400 rounded-full ring-8 ring-white size-8">
                <svg class="text-white size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                  <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z" />
                </svg>
              </span>
            </div>
            <div class="flex flex-1 justify-between pt-1.5 space-x-4 min-w-0">
              <div>
                <p class="text-sm text-gray-500">Applied to <a href="#" class="font-medium text-gray-900">Front End Developer</a></p>
              </div>
              <div class="text-sm text-right text-gray-500 whitespace-nowrap">
                <time datetime="2020-09-20">Sep 20</time>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="relative pb-8">
          <span class="absolute top-4 left-4 -ml-px w-0.5 h-full bg-gray-200" aria-hidden="true"></span>
          <div class="flex relative space-x-3">
            <div>
              <span class="flex justify-center items-center bg-blue-500 rounded-full ring-8 ring-white size-8">
                <svg class="text-white size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                  <path d="M1 8.25a1.25 1.25 0 1 1 2.5 0v7.5a1.25 1.25 0 1 1-2.5 0v-7.5ZM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0 1 14 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 0 1-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 0 1-1.341-.317l-2.734-1.366A3 3 0 0 0 6.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 0 1 2.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388Z" />
                </svg>
              </span>
            </div>
            <div class="flex flex-1 justify-between pt-1.5 space-x-4 min-w-0">
              <div>
                <p class="text-sm text-gray-500">Advanced to phone screening by <a href="#" class="font-medium text-gray-900">Bethany Blake</a></p>
              </div>
              <div class="text-sm text-right text-gray-500 whitespace-nowrap">
                <time datetime="2020-09-22">Sep 22</time>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="relative pb-8">
          <span class="absolute top-4 left-4 -ml-px w-0.5 h-full bg-gray-200" aria-hidden="true"></span>
          <div class="flex relative space-x-3">
            <div>
              <span class="flex justify-center items-center bg-green-500 rounded-full ring-8 ring-white size-8">
                <svg class="text-white size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                </svg>
              </span>
            </div>
            <div class="flex flex-1 justify-between pt-1.5 space-x-4 min-w-0">
              <div>
                <p class="text-sm text-gray-500">Completed phone screening with <a href="#" class="font-medium text-gray-900">Martha Gardner</a></p>
              </div>
              <div class="text-sm text-right text-gray-500 whitespace-nowrap">
                <time datetime="2020-09-28">Sep 28</time>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="relative pb-8">
          <span class="absolute top-4 left-4 -ml-px w-0.5 h-full bg-gray-200" aria-hidden="true"></span>
          <div class="flex relative space-x-3">
            <div>
              <span class="flex justify-center items-center bg-blue-500 rounded-full ring-8 ring-white size-8">
                <svg class="text-white size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                  <path d="M1 8.25a1.25 1.25 0 1 1 2.5 0v7.5a1.25 1.25 0 1 1-2.5 0v-7.5ZM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0 1 14 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 0 1-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 0 1-1.341-.317l-2.734-1.366A3 3 0 0 0 6.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 0 1 2.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388Z" />
                </svg>
              </span>
            </div>
            <div class="flex flex-1 justify-between pt-1.5 space-x-4 min-w-0">
              <div>
                <p class="text-sm text-gray-500">Advanced to interview by <a href="#" class="font-medium text-gray-900">Bethany Blake</a></p>
              </div>
              <div class="text-sm text-right text-gray-500 whitespace-nowrap">
                <time datetime="2020-09-30">Sep 30</time>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="relative pb-8">
          <div class="flex relative space-x-3">
            <div>
              <span class="flex justify-center items-center bg-green-500 rounded-full ring-8 ring-white size-8">
                <svg class="text-white size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                </svg>
              </span>
            </div>
            <div class="flex flex-1 justify-between pt-1.5 space-x-4 min-w-0">
              <div>
                <p class="text-sm text-gray-500">Completed interview with <a href="#" class="font-medium text-gray-900">Katherine Snyder</a></p>
              </div>
              <div class="text-sm text-right text-gray-500 whitespace-nowrap">
                <time datetime="2020-10-04">Oct 4</time>
              </div>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>



<div>
  <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 sm:py-24 lg:px-0">
    <div class="sm:flex sm:items-baseline sm:justify-between">
    <h2 class="text-3xl font-semibold tracking-tight text-gray-900 text-balance sm:text-2xl">Where to stay</h2>
      <a href="#" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
        Browse all hotels
        <span aria-hidden="true"> &rarr;</span>
      </a>
    </div>

    <div class="grid grid-cols-1 gap-y-6 mt-6 sm:grid-cols-2 sm:grid-rows-2 sm:gap-x-6 lg:gap-8">
      <div class="group relative aspect-[2/1] overflow-hidden rounded-lg sm:row-span-2 sm:aspect-square">
        <img src="https://tailwindui.com/plus/img/ecommerce-images/home-page-03-featured-category.jpg" alt="Two models wearing women's black cotton crewneck tee and off-white cotton crewneck tee." class="object-cover absolute size-full group-hover:opacity-75">
        <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
        <div class="flex absolute inset-0 items-end p-6">
          <div>
            <h3 class="font-semibold text-white">
              <a href="#">
                <span class="absolute inset-0"></span>
                New Arrivals
              </a>
            </h3>
            <p aria-hidden="true" class="mt-1 text-sm text-white">Shop now</p>
          </div>
        </div>
      </div>
      <div class="group relative aspect-[2/1] overflow-hidden rounded-lg sm:aspect-auto">
        <img src="https://tailwindui.com/plus/img/ecommerce-images/home-page-03-category-01.jpg" alt="Wooden shelf with gray and olive drab green baseball caps, next to wooden clothes hanger with sweaters." class="object-cover absolute size-full group-hover:opacity-75">
        <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
        <div class="flex absolute inset-0 items-end p-6">
          <div>
            <h3 class="font-semibold text-white">
              <a href="#">
                <span class="absolute inset-0"></span>
                Accessories
              </a>
            </h3>
            <p aria-hidden="true" class="mt-1 text-sm text-white">Shop now</p>
          </div>
        </div>
      </div>
      
      <div class="group relative aspect-[2/1] overflow-hidden rounded-lg sm:aspect-auto">
        <img src="https://tailwindui.com/plus/img/ecommerce-images/home-page-03-category-02.jpg" alt="Walnut desk organizer set with white modular trays, next to porcelain mug on wooden desk." class="object-cover absolute size-full group-hover:opacity-75">
        <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
        <div class="flex absolute inset-0 items-end p-6">
          <div>
            <h3 class="font-semibold text-white">
              <a href="#">
                <span class="absolute inset-0"></span>
                Workspace
              </a>
            </h3>
            <p aria-hidden="true" class="mt-1 text-sm text-white">Shop now</p>
          </div>
        </div>
      </div>
      
    </div>

    <div class="mt-6 sm:hidden">
      <a href="#" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500">
        Browse all categories
        <span aria-hidden="true"> &rarr;</span>
      </a>
    </div>
  </div>
</div>






  </div>
</div>
